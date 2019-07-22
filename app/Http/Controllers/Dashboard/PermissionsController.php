<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\dashboard\permission\CreatePermissionRequest;
use App\Http\Requests\dashboard\permission\UpdatePermissionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar permissões')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $permissions = Permission::Query();
        if ($search <> "") {
            $permissions->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }
        $permissions = $permissions->paginate($peer_page);
        if ($search) {
            $permissions->appends(['search' => $search]);
        }

        return view('dashboard.permission.list', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->can('Criar permissões')){
            return redirect()->back();
        }

        return view('dashboard.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
        if(!Auth::user()->can('Criar permissões')){
            return redirect()->route('dashboard.permission.list')->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('dashboard.permission.index')->withSuccess('Permissão criada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $permission_id
     * @return \Illuminate\Http\Response
     */
    public function edit($permission_id)
    {
        if(!Auth::user()->can('Editar permissões')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $edit = true;
        $permission = Permission::find($permission_id);

        return view('dashboard.permission.edit',compact('edit', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $permission_id)
    {
        if(!Auth::user()->can('Editar permissões')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }

        $permission = Permission::find($permission_id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->back()->withSuccess('Permissão atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($permission_id)
    {
        if(!Auth::user()->can('Excluir permissões')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação.');
        }
        $permission = Permission::find($permission_id);
        $permission->delete();

        return redirect()->route('dashboard.permission.index')->withSuccess('Permissão excluida com sucesso!');
    }
}
