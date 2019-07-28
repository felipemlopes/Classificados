<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Artist;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\MusicStyle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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

        $artists = Advertisement::query();
        $artists = $artists->select('advertisements.*','artists.*')
            ->join('artists', function ($join) {
                $join->on('artists.id', '=', 'advertisements.embedded_id');
                $join->where('embedded_type','=', 'App\Models\Artist');
            });
            if ($style <> "") {
                $artists->join('artist_musical_styles', function ($join) use ($style) {
                    $join->on('artists.id', '=', 'artist_musical_styles.artist_id');
                    $join->where('music_style_id','=', $style);
                });
            }
        if ($state <> "") {
            $artists->where(function ($q) use ($state) {
                $q->where('estado_id', "=", $state);
            });
        }
        if ($city <> "") {
            $artists->where(function ($q) use ($city) {
                $q->where('cidade_id', "=", $city);
            });
        }
        $artists = $artists->paginate($peer_page);

        $styles = MusicStyle::all();
        $states=Estado::all();
        $cities=Cidade::where('estado_id','=',$state)->get();

        return view('frontend.artists.index', compact('styles','states','cities',
            'artists'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Advertisement::with('embedded','embedded.musicalstyles')->Artist()
            ->where('embedded_id','=',$id)->first();
        //$artist = Artist::with('musicalstyles','embedded')->find($id);
        $url=$artist->embedded->video;
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        $videoyoutube = $my_array_of_vars['v'];

        return view('frontend.artists.show', compact('artist','videoyoutube'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
