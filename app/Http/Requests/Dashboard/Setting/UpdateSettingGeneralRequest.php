<?php

namespace App\Http\Requests\Dashboard\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingGeneralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'app_name' => 'required',
            'home_url' => 'required|url',
            'qtd_ads_destaque' => 'required|numeric',
            'days_ads_free' => 'required|numeric',
            'days_ads_premium' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'app_name.required' => 'Por favor preencha o campo nome do site',
            'home_url.required' => 'Por favor preencha o campo url da home',
            'qtd_ads_destaque.required' => 'Por favor preencha o campo "Quantidade de anúncios em destaque por página"',
            'days_ads_free.required' => 'Por favor preencha o campo "dias que um anúncio gratuito fica no sistema"',
            'days_ads_premium.required' => 'Por favor preencha o campo "dias que um anúncio premium fica no sistema"',
            'home_url.url' => 'O formato do campo url da home é inválido',
            'qtd_ads_destaque.numeric' => 'O campo "Quantidade de anúncios em destaque por página" deve ser um número',
            'days_ads_free.numeric' => 'O campo "dias que um anúncio gratuito fica no sistema" deve ser um número',
            'days_ads_premium.numeric' => 'O campo "dias que um anúncio premium fica no sistema" deve ser um número',
        ];
    }
}
