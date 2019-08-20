<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Setting\UpdateSettingGeneralRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    /**
     * Display general settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function general() {
        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back();
        }
        return view('dashboard.settings.general');
    }

    /**
     * Display Authentication & Registration settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auth() {
        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back();
        }
        return view('dashboard.settings.auth');
    }

    /**
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function updategeneral(UpdateSettingGeneralRequest $request) {

        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação');
        }
        $this->updateSettings($request->except("_token"));

        return back()->withSuccess('Configurações atualizadas com sucesso');
    }

    /**
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function updateauth(Request $request) {

        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação');
        }

        $this->updateSettings($request->except("_token"));

        return back()->withSuccess('Configurações atualizadas com sucesso');
    }

    /**
     * Update settings and fire appropriate event.
     *
     * @param $input
     */
    private function updateSettings($input) {
        foreach ($input as $key => $value) {
            setting([$key => $value])->save();
        }
    }
}
