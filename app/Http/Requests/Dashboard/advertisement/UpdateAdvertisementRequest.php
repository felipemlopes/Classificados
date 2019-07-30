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
                'title.required' => 'Por favor preencha o campo título',
                'description.required' => 'Por favor preencha o campo descrição',
                'estado.required' => 'Por favor selecione um estado',
                'cidade.required' => 'Por favor selecione uma cidade',
                'videoyoutube.url' => 'A url do vídeo do youtube está em um formato inválido',
                'estilos.required' => 'Por favor selecione pelo menos um estilo musical',
                'cache.required' => 'Por favor preencha o campo cachê',
            ];
        }else{   //profissional
            $msg = [
                'title.required' => 'Por favor preencha o campo título',
                'description.required' => 'Por favor preencha o campo descrição',
                'estado.required' => 'Por favor selecione um estado',
                'cidade.required' => 'Por favor selecione uma cidade',
                'categoria.required' => 'Por favor selecione uma categoria',
            ];
        }
        return $msg;
    }
}
