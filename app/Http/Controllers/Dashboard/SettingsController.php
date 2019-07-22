<?php

namespace App\Http\Controllers\Dashboard;

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
    public function update(Request $request) {

        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação');
        }
        $this->updateSettings(['registration.captcha.enabled' => true]);
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

    /**
     * Enable registration captcha.
     *
     * @return mixed
     */
    public function enableCaptcha() {
        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação');
        }
        $this->updateSettings(['registration.captcha.enabled' => true]);

        return back()->withSuccess('reCAPTCHA foi habilitado com sucesso');
    }

    /**
     * Disable registration captcha.
     *
     * @return mixed
     */
    public function disableCaptcha() {
        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação');
        }
        $this->updateSettings(['registration.captcha.enabled' => false]);

        return back()->withSuccess('reCAPTCHA foi desabilitado com sucesso');
    }

    /**
     * Display notification settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function plans() {
        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back();
        }
        return view('dashboard.settings.plans');
    }
}
