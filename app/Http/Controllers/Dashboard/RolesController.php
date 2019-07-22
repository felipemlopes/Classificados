<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\dashboard\role\CreateRoleRequest;
use App\Http\Requests\dashboard\role\UpdateRoleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar papéis')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $roles = Role::Query();
        if ($search <> "") {
            $roles->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }
        $roles = $roles->paginate($peer_page);
        if ($search) {
            $roles->appends(['search' => $search]);
        }

        return view('dashboard.role.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->can('Criar papéis')){
            return redirect()->back();
        }
        $permissions = Permission::all();

        return view('dashboard.role.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        if(!Auth::user()->can('Criar papéis')){
            return redirect()->route('dashboard.role.list')->withErrors('Você não esta autorizado a executar esta ação');
        }

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        $role->permissions()->sync($request->permissions);

        return redirect()->route('dashboard.role.index')->withSuccess('Papel criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role_id)
    {
        if(!Auth::user()->can('Editar papéis')){
            return redirect()->back();
        }
        $edit = true;
        $role = Role::find($role_id);
        $permissions = Permission::all();


        return view('dashboard.role.edit',compact('edit', 'role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $role_id)
    {
        if(!Auth::user()->can('Editar papéis')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação');
        }

        $role = Role::find($role_id);
        $role->permissions()->sync($request->permissions);
        $role->name = $request->name;
        $role->save();

        return redirect()->back()->withSuccess('Papel atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role_id)
    {
        if(!Auth::user()->can('Excluir papéis')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação');
        }
        $role = Role::find($role_id);
        $role->delete();

        return redirect()->route('dashboard.role.index')->withSuccess('Papel excluido com sucesso!');
    }
}
