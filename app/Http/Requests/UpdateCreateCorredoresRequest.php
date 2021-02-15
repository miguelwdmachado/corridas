<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreateCorredoresRequest extends FormRequest
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
            'nome' => 'required|min:3|max:255',
            'cpf' => 'required',
            'dt_nascimento' => 'required',
        ];
    }

    public function messages()
    {

        return [
            '_token.required' => '_token é obrigatório',
            'nome.required' => 'nome é obrigatório',
            'cpf.required' => 'cpf é obrigatório',
            'dt_nascimento.required' => 'data de nascimento é obrigatório',
        ];
    }

}
