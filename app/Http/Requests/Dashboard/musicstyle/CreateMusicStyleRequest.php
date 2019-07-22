<?php

namespace App\Http\Requests\dashboard\musicstyle;

use Illuminate\Foundation\Http\FormRequest;

class CreateMusicStyleRequest extends FormRequest
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
            'name' => 'required|unique:music_styles,name'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor preencha o campo nome',
            'name.unique' => 'Este nome já esta em uso',
        ];
    }
}
