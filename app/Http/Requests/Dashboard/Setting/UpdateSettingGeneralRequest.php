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
            'qtd_ads_artist_freeaccount' => 'required|numeric',
            'qtd_ads_pro_freeaccount' => 'required|numeric',
            'qtd_ads_destaque' => 'required|numeric',
            'days_ads_free' => 'required|numeric',
            'days_ads_premium' => 'required|numeric',
            'price_ads_premium' => 'required|regex:/^\d+(\,\d{1,2})?/',
        ];
    }

    public function messages()
    {
        return [
            'app_name.required' => 'Por favor preencha o campo nome do site',
            'home_url.required' => 'Por favor preencha o campo url da home',
            'home_url.url' => 'O formato do campo url da home é inválido',
            'qtd_ads_artist_freeaccount.required' => 'Por favor preencha o campo "Quantidade de anúncios de artistas ativos para usuário gratuito"',
            'qtd_ads_artist_freeaccount.numeric' => 'O campo "Quantidade de anúncios de artistas ativos para usuário gratuito" deve ser um número',
            'qtd_ads_pro_freeaccount.required' => 'Por favor preencha o campo "Quantidade de anúncios de profissionais ativos para usuário gratuito"',
            'qtd_ads_pro_freeaccount.numeric' => 'O campo "Quantidade de anúncios de profissionais ativos para usuário gratuito" deve ser um número',
            'qtd_ads_destaque.required' => 'Por favor preencha o campo "Quantidade de anúncios em destaque por página"',
            'qtd_ads_destaque.numeric' => 'O campo "Quantidade de anúncios em destaque por página" deve ser um número',
            'days_ads_free.required' => 'Por favor preencha o campo "dias que um anúncio gratuito fica no sistema"',
            'days_ads_free.numeric' => 'O campo "dias que um anúncio gratuito fica no sistema" deve ser um número',
            'days_ads_premium.required' => 'Por favor preencha o campo "dias que um anúncio premium fica no sistema"',
            'days_ads_premium.numeric' => 'O campo "dias que um anúncio premium fica no sistema" deve ser um número',
            'price_ads_premium.required' => 'Por favor preencha o campo "Valor pago por anúncio em destaque"',
            'price_ads_premium.numeric' => 'O campo "Valor pago por anúncio em destaque" deve ser um número',
            'price_ads_premium.regex' => 'Formato inválido do campo "Valor pago por anúncio em destaque"',
        ];
    }
}
