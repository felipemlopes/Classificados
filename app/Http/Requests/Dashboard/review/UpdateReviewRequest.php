<?php

namespace App\Http\Requests\dashboard\review;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Permission;

class UpdateReviewRequest extends FormRequest
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
            'title' => 'required',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Por favor preencha o campo título',
            'body.required' => 'Por favor preencha o campo avaliação',
        ];
    }
}
