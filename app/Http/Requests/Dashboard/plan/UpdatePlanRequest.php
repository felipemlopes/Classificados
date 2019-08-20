<?php

namespace App\Http\Requests\dashboard\plan;

use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
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
        $plan = Plan::where('name','=',$this->request->get('name'))->first();
        if($plan){
            return [
                'name' => 'required|unique:plans,name,'.$plan->id,
                'price' => 'required|regex:/^\d+(\,\d{1,2})?/',
                'qtd_ads_art' => 'required|numeric',
                'qtd_ads_pro' => 'required|numeric',
            ];
        }else{
            return [
                'name' => 'required|unique:plans,name',
                'price' => 'required|regex:/^\d+(\,\d{1,2})?/',
                'qtd_ads_art' => 'required|numeric',
                'qtd_ads_pro' => 'required|numeric',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor preencha o campo nome',
            'name.unique' => 'Este nome já esta em uso',
            'price.required' => 'Por favor preencha o campo preço',
            'price.regex' => 'O formato do campo preço é inválido',
            'qtd_ads_art.required' => 'Por favor preencha o campo "Quantidade de anúncios de artistas ativos"',
            'qtd_ads_art.numeric' => 'O campo "Quantidade de anúncios de artistas ativos" deve ser um número',
            'qtd_ads_pro.required' => 'Por favor preencha o campo "Quantidade de anúncios de profissionais ativos"',
            'qtd_ads_pro.numeric' => 'O campo "Quantidade de anúncios de profissionais ativos"deve ser um número',


        ];
    }
}
