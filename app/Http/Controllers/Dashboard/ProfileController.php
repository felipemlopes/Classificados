<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\dashboard\user\UpdateProfileDetailsRequest;
use App\Http\Requests\dashboard\user\UpdateLoginDetailsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edit = true;
        $user = Auth::User();

        return view('dashboard.user.profile',compact('edit','user'));
    }

    /**
     * Update informações do usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(UpdateProfileDetailsRequest $request)
    {

        $user = Auth::User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->withSuccess('Perfil atualizado com sucesso!');
    }

    /**
     * Update informações de login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLoginDetails(UpdateLoginDetailsRequest $request)
    {
        $user = Auth::User();
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->withSuccess('Perfil atualizado com sucesso!');
    }

}
