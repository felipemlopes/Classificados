<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\dashboard\musicstyle\CreateMusicStyleRequest;
use App\Http\Requests\dashboard\musicstyle\UpdateMusicStyleRequest;
use App\Models\MusicStyle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;


class MusicStylesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar estilos musicais')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $styles = MusicStyle::Query();
        if ($search <> "") {
            $styles->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }
        $styles = $styles->paginate($peer_page);
        if ($search) {
            $styles->appends(['search' => $search]);
        }

        return view('dashboard.musicstyle.list', compact('styles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->can('Criar estilos musicais')){
            return redirect()->back();
        }

        return view('dashboard.musicstyle.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMusicStyleRequest $request)
    {
        if(!Auth::user()->can('Criar estilos musicais')){
            return redirect()->route('dashboard.musicstyle.list')->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $style = new MusicStyle();
        $style->name = $request->name;
        $style->slug = Str::slug($request->name, '-');
        $style->save();

        return redirect()->route('dashboard.musicstyle.list')->withSuccess('Estilo musical criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $permission_id
     * @return \Illuminate\Http\Response
     */
    public function edit($musicstyle_id)
    {
        if(!Auth::user()->can('Editar estilos musicais')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $edit = true;
        $style = MusicStyle::find($musicstyle_id);

        return view('dashboard.musicstyle.edit',compact('edit', 'style'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMusicStyleRequest $request, $musicstyle_id)
    {
        if(!Auth::user()->can('Editar estilos musicais')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $style = MusicStyle::find($musicstyle_id);
        $style->name = $request->name;
        $style->slug = Str::slug($request->name, '-');
        $style->save();

        return redirect()->back()->withSuccess('Estilo musical atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($musicstyle_id)
    {
        if(!Auth::user()->can('Excluir estilos musicais')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $style = MusicStyle::find($musicstyle_id);
        $style->delete();

        return redirect()->route('dashboard.musicstyle.list')->withSuccess('Estilo musical excluido com sucesso!');
    }
}
