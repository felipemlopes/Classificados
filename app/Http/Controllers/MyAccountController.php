<?php

namespace App\Http\Controllers;

use App\Http\Requests\frontend\myaccount\UpdateAdvertisementImageRequest;
use App\Http\Requests\frontend\myaccount\UpdateAdvertisementRequest;
use App\Http\Requests\frontend\myaccount\UpdateDetailsRequest;
use App\Http\Requests\frontend\myaccount\UpdateLoginDetailsRequest;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\MusicStyle;
use App\models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('frontend.myaccount.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {

        return view('frontend.myaccount.settings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settingsupdate(UpdateDetailsRequest $request)
    {
        $user = User::find(Auth::User()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->withSuccess('Configurações atualizadas com sucesso!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settingsupdatepassword(UpdateLoginDetailsRequest $request)
    {
        $user = User::find(Auth::User()->id);
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->withSuccess('Configurações atualizadas com sucesso!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function advertisement()
    {
        $peer_page = 15;
        $search = Input::get('search');
        $type = Input::get('tipo');
        $advertisements = Advertisement::Query();
        if ($search <> "") {
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
        return view('frontend.myaccount.advertisement', compact('advertisements'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function advertisementEdit($id)
    {
        $edit = true;
        $advertisement = Advertisement::find($id);
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

        return view('frontend.myaccount.advertisementedit',compact('edit', 'advertisement','estilos',
            'estados','cidades','categorias','subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function advertisementUpdate(UpdateAdvertisementRequest $request, $id)
    {
        $advertisement = Advertisement::find($id);
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function advertisementUpdateImage(UpdateAdvertisementImageRequest $request, $id)
    {
        $advertisement = Advertisement::find($id);
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
    public function advertisementDelete($id)
    {
        $advertisement = Advertisement::find($id);
        $advertisement->delete();

        return redirect()->route('myaccount.advertisement')->withSuccess('Anúncio excluido com sucesso!');
    }


}
