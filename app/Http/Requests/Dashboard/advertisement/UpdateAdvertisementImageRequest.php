<?php

namespace App\Http\Requests\dashboard\advertisement;

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
        return  [
            'foto' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2048'
        ];
    }


    public function messages()
    {
        return [
            'foto.required' => 'Por favor selecione uma imagem para o anúncio',
            'foto.image' => 'A foto deve ser uma imagem',
            'foto.mimes' => 'A foto deve ser um arquivo do tipo jpg, png ou bmp',
            'foto.max' => 'A foto não pode ser maior que 2048 kilobytes (2mb)',
        ];
    }
}
