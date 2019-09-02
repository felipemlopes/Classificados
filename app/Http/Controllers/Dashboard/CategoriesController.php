<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Requests\dashboard\category\CreateCategoryRequest;
use App\Http\Requests\dashboard\category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar categorias')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $categoria = Input::get('category');
        $categories = Category::Query();
        if ($search <> "") {
            $categories->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }
        if ($categoria <> "") {
            $categories->where(function ($q) use ($categoria) {
                $q->where('parent_id', $categoria);
            });
        }
        $categories = $categories->paginate($peer_page);
        if ($search) {
            $categories->appends(['search' => $search]);
        }
        if ($categoria) {
            $categories->appends(['category' => $categoria]);
        }
        $categoriaspai = Category::where('parent_id',null)->get();

        return view('dashboard.category.list', compact('categories','categoriaspai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->can('Criar categorias')){
            return redirect()->back();
        }
        $categories = Category::select('id','name')->where('parent_id','=',null)->get();

        return view('dashboard.category.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        if(!Auth::user()->can('Criar categorias')){
            return redirect()->route('dashboard.category.list')->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('dashboard.category.list')->withSuccess('Categoria criada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $permission_id
     * @return \Illuminate\Http\Response
     */
    public function edit($category_id)
    {
        if(!Auth::user()->can('Editar categorias')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $edit = true;
        $category = Category::find($category_id);
        $categories = Category::select('id','name')->where('parent_id','=',null)->get();

        return view('dashboard.category.edit',compact('edit', 'category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $category_id)
    {
        if(!Auth::user()->can('Editar categorias')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $category = Category::find($category_id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->back()->withSuccess('Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        if(!Auth::user()->can('Excluir categorias')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $category = Category::find($category_id);
        $category->delete();

        return redirect()->route('dashboard.category.list')->withSuccess('Categoria excluida com sucesso!');
    }
}
