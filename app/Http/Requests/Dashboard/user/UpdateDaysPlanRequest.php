<?php

namespace App\Http\Requests\dashboard\user;

use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDaysPlanRequest extends FormRequest
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
            'days' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'days.required' => 'Por favor preencha o campo dias',
            'days.numeric' => 'O campo dias deve ser um número',
        ];
    }
}
