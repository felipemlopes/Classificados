<?php

namespace App\Http\Requests\frontend\anuncio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateReviewRequest extends FormRequest
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
            'title' => 'required',
            'body' => 'required',
            'rating' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Por favor informe o título',
            'body.required' => 'Por favor informe a sua opnião',
            'rating.required' => 'Por favor selecione pelo menos uma estrela',
        ];
    }
}
