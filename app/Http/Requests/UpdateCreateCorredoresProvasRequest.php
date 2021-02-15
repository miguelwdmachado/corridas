<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreateCorredoresProvasRequest extends FormRequest
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
            'corredor_id' => 'required',
            'prova_id' => 'required',
        ];
    }

    public function messages()
    {

        return [
            '_token.required' => '_token é obrigatório',
            'corredor_id.required' => 'corredor_id é obrigatório',
            'prova_id.required' => 'prova_id é obrigatório',
        ];
    }

}
