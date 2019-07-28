<?php

namespace App\Http\Requests\dashboard\advertisement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdvertisementRequest extends FormRequest
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
        $type = $this->request->get('type');
        $rule = null;
        if($type==1){ //artista
            $rule = [
                'title' => 'required',
                'description' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'videoyoutube' => 'url',
                'estilos' => 'required',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
                'cache' => 'required|regex:/^\d+(\,\d{1,2})?/',
            ];
        }else{ //profissional
            $rule = [
                'title' => 'required',
                'description' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'categoria' => 'required',
                'subcategoria' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
            ];
        }
        return $rule;
    }


    public function messages()
    {
        $type = $this->request->get('type');
        if($type==1){ //artista
            $msg = [
                'type.required' => 'Por favor preencha o campo tipo de anúncio',
                'title.required' => 'Por favor preencha o campo título',
                'description.required' => 'Por favor preencha o campo descrição',
                'estado.required' => 'Por favor selecione um estado',
                'cidade.required' => 'Por favor selecione uma cidade',
                'estilos.required' => 'Por favor selecione pelo menos um estilo musical',
                'cache.required' => 'Por favorpreencha o campo cache',
            ];
        }else{   //profissional
            $msg = [
                'type.required' => 'Por favor preencha o campo tipo de anúncio',
                'title.required' => 'Por favor preencha o campo título',
                'description.required' => 'Por favor preencha o campo descrição',
                'estado.required' => 'Por favor selecione um estado',
                'cidade.required' => 'Por favor selecione uma cidade',
                'categoria.required' => 'Por favor selecione uma categoria',
                'subcategoria.required' => 'Por favor selecione uma subcategoria',
            ];
        }
        return $msg;
    }
}
