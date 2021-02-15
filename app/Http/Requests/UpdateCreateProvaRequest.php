<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCreateProvaRequest extends FormRequest
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
            'tipo_prova_id' => 'required',
            'data' => 'required',
        ];
    }

    public function messages()
    {

        return [
            '_token.required' => '_token é obrigatório',
            'tipo_prova_id.required' => 'tipo_prova_id é obrigatório',
            'data.required' => 'data é obrigatória',
        ];
    }

}
