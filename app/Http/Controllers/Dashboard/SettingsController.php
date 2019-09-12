<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Setting\UpdateSettingGeneralRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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

    public function pagseguro() {
        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back();
        }
        $email = env('PAGSEGURO_EMAIL');
        $token = env('PAGSEGURO_TOKEN');

        return view('dashboard.settings.pagseguro', compact('email', 'token'));
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

    public function updatepagseguro(Request $request) {

        if(!Auth::user()->can('Gerenciar configurações')){
            return redirect()->back()->withErrors('Você não esta autorizado para executar esta ação');
        }

        $email = $request->email;
        $token = $request->token;

        if($email!=""){
            $this->updateDotEnv('PAGSEGURO_EMAIL', $email, $delim='');
        }
        if($token!=""){
            $this->updateDotEnv('PAGSEGURO_TOKEN', $token, $delim='');
        }


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

    protected function updateDotEnv($key, $newValue, $delim='')
    {

        $path = base_path('.env');
        // get old value from current env
        $oldValue = env($key);

        // was there any change?
        if ($oldValue === $newValue) {
            return;
        }

        // rewrite file content with changed data
        if (file_exists($path)) {
            // replace current value with new value
            file_put_contents(
                $path, str_replace(
                    $key.'='.$delim.$oldValue.$delim,
                    $key.'='.$delim.$newValue.$delim,
                    file_get_contents($path)
                )
            );
        }
    }
}
