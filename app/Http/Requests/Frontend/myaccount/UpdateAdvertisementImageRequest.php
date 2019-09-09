<?php

namespace App\Http\Requests\frontend\myaccount;

use App\Models\Advertisement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdvertisementImageRequest extends FormRequest
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
        //tem que continuar com a primeira imagem
        $ads = Advertisement::find($this->request->get('id'));
        if($ads->embedded->imagepath!=""){
            $foto = 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048';
        }else{
            $foto = 'required|image|mimes:jpg,jpeg,bmp,png|max:2048';
        }

        return  [
            'foto' => $foto,
            'foto2' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048',
            'foto3' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048',
            'foto4' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048',
            'foto5' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:2048',
        ];
    }


    public function messages()
    {
        return [
            'foto.required' => 'Por favor selecione uma imagem para foto 1',
            'foto.image' => 'A foto 1 deve ser uma imagem',
            'foto.mimes' => 'A foto 1 deve ser um arquivo do tipo jpg, png ou bmp',
            'foto.max' => 'A foto 1 não pode ser maior que 2048 kilobytes (2mb)',

            'foto2.image' => 'A foto 2 deve ser uma imagem',
            'foto2.mimes' => 'A foto 2 deve ser um arquivo do tipo jpg, png ou bmp',
            'foto2.max' => 'A foto 2 não pode ser maior que 2048 kilobytes (2mb)',

            'foto3.image' => 'A foto 3 deve ser uma imagem',
            'foto3.mimes' => 'A foto 3 deve ser um arquivo do tipo jpg, png ou bmp',
            'foto3.max' => 'A foto 3 não pode ser maior que 2048 kilobytes (2mb)',

            'foto4.image' => 'A foto 4 deve ser uma imagem',
            'foto4.mimes' => 'A foto 4 deve ser um arquivo do tipo jpg, png ou bmp',
            'foto4.max' => 'A foto 4 não pode ser maior que 2048 kilobytes (2mb)',

            'foto5.image' => 'A foto 5 deve ser uma imagem',
            'foto5.mimes' => 'A foto 5 deve ser um arquivo do tipo jpg, png ou bmp',
            'foto5.max' => 'A foto 5 não pode ser maior que 2048 kilobytes (2mb)',
        ];
    }
}
