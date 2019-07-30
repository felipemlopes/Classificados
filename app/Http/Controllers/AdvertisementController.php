<?php

namespace App\Http\Controllers;

use App\Http\Requests\frontend\anuncio\CreateAnuncioRequest;
use App\Models\Advertisement;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Estado;
use App\Models\File;
use App\Models\MusicStyle;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estilos = MusicStyle::all();
        $estados = Estado::all();
        $categorias = Category::where('parent_id','=',null)->get();

        return view('frontend.advertisement.index', compact('estilos','estados','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnuncioRequest $request)
    {
        $type = $request->type;
        $file = Input::file('foto');
        $path = '';
        if($file){
            $path = Storage::disk('public_uploads')->put('/', $file);
        }
        if($type==1){
            $artist = new Artist();
            $artist->title = $request->title;
            $artist->description = $request->description;
            $artist->cache = $request->cache;
            $artist->video = $request->videoyoutube;
            $artist->facebook = $request->facebook;
            $artist->instagram = $request->instagram;
            $artist->youtube = $request->youtube;
            $artist->imagepath = $path;
            $artist->save();
            $artist->musicalstyles()->sync($request->estilos);

            $advertisement = new Advertisement();
            $advertisement->user_id = Auth::User()->id;
            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->embedded_type = 'App\Models\Artist';
            $advertisement->embedded_id = $artist->id;
            $advertisement->save();

            return redirect()->route('artist.index')->withSuccess('Anúncio criado com sucesso!');
        }else{
            $professional = new Professional();
            $professional->title = $request->title;
            $professional->description = $request->description;
            $professional->category_id = $request->categoria;
            $professional->subcategory_id = $request->subcategoria;
            $professional->facebook = $request->facebook;
            $professional->instagram = $request->instagram;
            $professional->youtube = $request->youtube;
            $professional->imagepath = $path;
            $professional->save();

            $advertisement = new Advertisement();
            $advertisement->user_id = Auth::User()->id;
            $advertisement->estado_id = $request->estado;
            $advertisement->cidade_id = $request->cidade;
            $advertisement->embedded_type = 'App\Models\Professional';
            $advertisement->embedded_id = $professional->id;
            $advertisement->save();

            return redirect()->route('professional.index')->withSuccess('Anúncio criado com sucesso!');
        }

    }

}
