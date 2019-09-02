<?php

namespace App\Http\Requests\frontend\anuncio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAnuncioRequest extends FormRequest
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
        $edit = $this->request->get('edit');
        $type = $this->request->get('type');
        $foto = $this->request->get('foto');
        if($foto==null){
            $img = 'required|image|mimes:jpg,jpeg,bmp,png|max:2048';
        }else{
            $img = 'required|image|mimes:jpg,jpeg,bmp,png|max:2048';
        }
        if($edit==1 and $foto==null){
            $img = 'image|mimes:jpg,jpeg,bmp,png|max:2048';
        }
        $rule = null;
        if($type==1){ //artista
            $rule = [
                'type' => 'required',
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
                'foto' => $img,
            ];
        }else{ //profissional
            $rule = [
                'type' => 'required',
                'title' => 'required',
                'description' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'categoria' => 'required',
                'subcategoria' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
                'foto' => $img,
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
                'videoyoutube.url' => 'A url do vídeo do youtube está em um formato inválido',
                'estilos.required' => 'Por favor selecione pelo menos um estilo musical',
                'cache.required' => 'Por favor preencha o campo cachê',
                'cache.regex' => 'O formato do campo cachê é inválido',
                'foto.required' => 'Por favor selecione uma imagem para o anúncio',
                'foto.image' => 'A foto deve ser uma imagem',
                'foto.mimes' => 'A foto deve ser um arquivo do tipo jpg, png ou bmp',
                'foto.max' => 'A foto não pode ser maior que 2048 kilobytes (2mb)',
                'foto.uploaded' => 'A foto falhou ao ser enviada, verifique se ela não ultrapassa o limite de 2Mb e tente novamente',
            ];
        }else{   //profissional
            $msg = [
                'type.required' => 'Por favor preencha o campo tipo de anúncio',
                'title.required' => 'Por favor preencha o campo título',
                'description.required' => 'Por favor preencha o campo descrição',
                'estado.required' => 'Por favor selecione um estado',
                'cidade.required' => 'Por favor selecione uma cidade',
                'categoria.required' => 'Por favor selecione uma categoria',
                'foto.required' => 'Por favor selecione uma imagem para o anúncio',
                'foto.image' => 'A foto deve ser uma imagem',
                'foto.mimes' => 'A foto deve ser um arquivo do tipo jpg, png ou bmp',
                'foto.max' => 'A foto não pode ser maior que 2048 kilobytes (2mb)',
                'foto.uploaded' => 'A foto falhou ao ser enviada, verifique se ela não ultrapassa o limite de 2Mb e tente novamente',
            ];
        }
        return $msg;
    }
}
