<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Requests\dashboard\advertisement\UpdateAdvertisementRequest;
use App\Http\Requests\dashboard\category\CreateCategoryRequest;
use App\Http\Requests\dashboard\category\UpdateCategoryRequest;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\MusicStyle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdvertisementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar anúncios')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $type = Input::get('tipo');
        $advertisements = Advertisement::Query();
        if ($search <> "") {
            $advertisements->orwhereHas('user', function (Builder $query) use ($search) {
                $query->where('email', 'like', "%{$search}%");
            });
            $advertisements->orwhereHasMorph('embedded','*', function (Builder $query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            });
            $advertisements->orwhereHasMorph('embedded','*', function (Builder $query) use ($search) {
                $query->where('description', 'like', "%{$search}%");
            });
        }
        if($type <> ""){
            if($type==1){
                $advertisements->Artist();
            }elseif($type==2){
                $advertisements->Professional();
            }

        }
        $advertisements = $advertisements->paginate($peer_page);
        if ($search) {
            $advertisements->appends(['search' => $search]);
        }
        if ($type) {
            $advertisements->appends(['tipo' => $type]);
        }

        return view('dashboard.advertisement.list', compact('advertisements'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $permission_id
     * @return \Illuminate\Http\Response
     */
    public function edit($advertisement_id)
    {
        if(!Auth::user()->can('Editar anúncios')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $edit = true;
        $advertisement = Advertisement::find($advertisement_id);
        $estilos = null;
        $categorias = null;
        $subcatecorias = null;
        if($advertisement->embedded_type=="App\Models\Artist"){
            $estilos=MusicStyle::all();
        }else{
            $categorias = Category::All();
            $subcategorias = Category::where('parent_id','=',$advertisement->embedded->category_id)->get();
        }
        $estados = Estado::all();
        $cidades=Cidade::where('estado_id','=',$advertisement->estado_id)->get();

        return view('dashboard.advertisement.edit',compact('edit', 'advertisement','estilos',
            'estados','cidades','categorias','subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertisementRequest $request, $advertisement_id)
    {
        if(!Auth::user()->can('Editar anúncios')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $advertisement = Advertisement::find($advertisement_id);
        $advertisement->estado_id = $request->estado;
        $advertisement->cidade_id = $request->cidade;
        $advertisement->save();

        if($advertisement->embedded_type=="App\Models\Artist"){
            $embedded = $advertisement->embedded;
            $embedded->title = $request->title;
            $embedded->description = $request->description;
            $embedded->cache = $request->cache;
            $embedded->video = $request->videoyoutube;
            $embedded->facebook = $request->facebook;
            $embedded->instagram = $request->instagram;
            $embedded->youtube = $request->youtube;
            $embedded->save();
            $embedded->musicalstyles()->sync($request->estilos);
        }else{
            $embedded = $advertisement->embedded;
            $embedded->title = $request->title;
            $embedded->description = $request->description;
            $embedded->category_id = $request->categoria;
            $embedded->subcategory_id = $request->subcategoria;
            $embedded->facebook = $request->facebook;
            $embedded->instagram = $request->instagram;
            $embedded->youtube = $request->youtube;
            $embedded->save();
        }


        return redirect()->back()->withSuccess('Anúncio atualizado com sucesso!');
    }

    public function updateImage(Request $request, $advertisement_id)
    {
        if(!Auth::user()->can('Editar anúncios')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $advertisement = Advertisement::find($advertisement_id);
        $embedded = $advertisement->embedded;
        $aux = $embedded->imagepath;
        $file = Input::file('foto');
        $path = '';
        if($file){
            $path = Storage::disk('public_uploads')->put('/', $file);
        }
        $embedded->imagepath = $path;
        $embedded->save();
        Storage::disk('public_uploads')->delete($aux);

        return redirect()->back()->withSuccess('Anúncio atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($advertisement_id)
    {
        if(!Auth::user()->can('Excluir anúncios')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $advertisement = Advertisement::find($advertisement_id);
        $advertisement->delete();

        return redirect()->route('dashboard.advertisement.list')->withSuccess('Anúncio excluido com sucesso!');
    }
}
