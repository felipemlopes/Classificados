<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\dashboard\user\CreateAnuncioRequest;
use App\Http\Requests\dashboard\user\CreateUserRequest;
use App\Http\Requests\dashboard\user\UpdateDetailsRequest;
use App\Http\Requests\dashboard\user\UpdateLoginDetailsRequest;
use App\Models\User;
use App\Support\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peer_page = 15;
        $search = Input::get('search');
        $users = User::Query();
        if ($search <> "") {
            $users->where(function ($q) use ($search) {
                $q->where('first_name', "like", "%{$search}%");
                $q->orwhere('last_name', "like", "%{$search}%");
            });
        }
        $users = $users->paginate($peer_page);
        if ($search) {
            $users->appends(['search' => $search]);
        }

        return view('dashboard.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->can('Criar usuário')){
            return redirect()->back();
        }
        $roles = Role::all();

        return view('dashboard.user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        if(!Auth::user()->can('Criar usuário')){
            return redirect()->route('dashboard.user.list')->withErrors('Você não está autorizado para executar esta ação.');
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $role = Role::where('id',$request->role)->first();
        $user->syncRoles($role->name);
        $user->save();


        return redirect()->route('dashboard.user.list')->withSuccess('Usuário criado com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        if(!Auth::user()->can('Editar usuário')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação.');
        }
        $edit = true;
        $user = User::find($user_id);
        $roles = Role::pluck('name','id');
        $permissions = Permission::all();

        return view('dashboard.user.edit',compact('edit', 'user', 'roles', 'permissions','statuses','ongs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(UpdateDetailsRequest $request, $user_id)
    {
        if(!Auth::user()->can('Editar usuário')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação.');
        }

        $user = User::find($user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->withSuccess('Usuário atualizado com sucesso!');
    }


    /**
     * Update login information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function updateLoginDetails(UpdateLoginDetailsRequest $request, $user_id)
    {
        if(!Auth::user()->can('Editar usuário')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação.');
        }

        $user = User::find($user_id);
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->withSuccess('Usuário atualizado com sucesso!');
    }


    /**
     * Update role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, $user_id)
    {
        if(!Auth::user()->can('Gerenciar papel usuário')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação');
        }

        $role = Role::where('name',$request->roles)->first();
        $user = User::find($user_id);
        $user->syncRoles($role->name);
        $user->save();

        return redirect()->back()->withSuccess('Usuário atualizado com sucesso!');
    }

    /**
     * Update role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function updatePermissions(Request $request, $user_id)
    {
        if(!Auth::user()->can('Gerenciar permissões usuário')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação');
        }

        $user = User::find($user_id);
        $user->permissions()->sync($request->permissions);
        $user->save();

        return redirect()->back()->withSuccess('Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        if(!Auth::user()->can('Excluir usuário')){
            return redirect()->back()->withErrors('Você não esta autorizado a executar esta ação');
        }
        if(Auth::user()->id == $user_id){
            return redirect()->back()->withErrors('Você não pode excluir esse usuário.');
        }
        $user = User::find($user_id);
        $user->delete();

        return redirect()->route('dashboard.user.list')->withSuccess('Usuário excluido com sucesso!');
    }
}
