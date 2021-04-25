<?php

namespace AdminEspindola\Http\Requests;

use AdminEspindola\Http\Requests\Request;

class UserRequest extends Request
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
    *Criado em 10/07/2016 as 10:05 by Junior Oliveira
     */

    public function rules()
    {
        return [
            'name'              => 'required|min:3',
            'email'             => 'required',
            'receive_proposal'  => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'             => 'O nome do usuário é obrigatório',
            'email.required'            => 'O e-mail do usuário é obrigatório',
            'receive_proposal.required' => 'Saber se ele recebe a proposta é obrigatório'
           
        ];
    }
}
