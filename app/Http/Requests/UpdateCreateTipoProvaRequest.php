<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreateTipoProvaRequest extends FormRequest
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
            '_token' => 'required',
            'tipo' => 'required',
        ];
    }

    public function messages()
    {

        return [
            '_token.required' => '_token é obrigatório',
            'tipo.required' => '_tipo é obrigatório',
        ];
    }

}
