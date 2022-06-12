<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginProfessor extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|exists:professores,email',
            'senha' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'exists'   => 'Email não encontrado'
        ];
    }
}
