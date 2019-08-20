<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Artist;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\MusicStyle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peer_page = 15;
        $style= Input::get('estilo');
        $state= Input::get('estado');
        $city= Input::get('cidade');
        $qtd_destaque = setting('qtd_ads_destaque');

        $destaques = Advertisement::Artist()->Published()->Featured()->Paid();


        $artists = Advertisement::query()->Published();
        $artists = $artists->select('advertisements.*','artists.*')
            ->join('artists', function ($join) {
                $join->on('artists.id', '=', 'advertisements.embedded_id');
                $join->where('embedded_type','=', 'App\Models\Artist');
            });
        $destaques->select('advertisements.*','artists.*')
            ->join('artists', function ($join) {
                $join->on('artists.id', '=', 'advertisements.embedded_id');
                $join->where('embedded_type','=', 'App\Models\Artist');
            });
            if ($style <> "") {
                $artists->join('artist_musical_styles', function ($join) use ($style) {
                    $join->on('artists.id', '=', 'artist_musical_styles.artist_id');
                    $join->where('music_style_id','=', $style);
                });
                $destaques->join('artist_musical_styles', function ($join) use ($style) {
                    $join->on('artists.id', '=', 'artist_musical_styles.artist_id');
                    $join->where('music_style_id','=', $style);
                });
            }
        if ($state <> "") {
            $artists->where(function ($q) use ($state) {
                $q->where('estado_id', "=", $state);
            });
            $destaques->where(function ($q) use ($state) {
                $q->where('estado_id', "=", $state);
            });
        }
        if ($city <> "") {
            $artists->where(function ($q) use ($city) {
                $q->where('cidade_id', "=", $city);
            });
            $destaques->where(function ($q) use ($city) {
                $q->where('cidade_id', "=", $city);
            });
        }
        $artists = $artists->paginate($peer_page);
        $destaques = $destaques->take($qtd_destaque)->inRandomOrder()->get();
        if ($style) {
            $artists->appends(['estilo' => $style]);
        }
        if ($state) {
            $artists->appends(['estado' => $state]);
        }
        if ($city) {
            $artists->appends(['cidade' => $city]);
        }

        $styles = MusicStyle::all();
        $states=Estado::all();
        $cities=Cidade::where('estado_id','=',$state)->get();

        return view('frontend.artists.index', compact('styles','states','cities',
            'artists','destaques'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Advertisement::with('ratings','embedded','embedded.musicalstyles')->Artist()
            ->where('id','=',$id)->first();
        $url=$artist->embedded->video;
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        $videoyoutube = $my_array_of_vars['v'];

        return view('frontend.artists.show', compact('artist','videoyoutube'));
    }

}
