<?php

namespace App\Http\Requests\Pessoa;

use Illuminate\Foundation\Http\FormRequest;

class PessoaFormRequest extends FormRequest
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
            // 'id'=>'required|unique:pessoas',
            'cpf' => 'required|cpf|formato_cpf|max: 14|unique:pessoas',
            'idade' => 'max:3',
            'telefone' => 'max:14',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Infome o id do usuário.',
            'id.unique' => 'id informado já cadastrado.',
            'cpf.required' => 'Informe o número do CPF',
            'cpf.unique' => 'CPF já cadastrado.',
            'cpf.max' =>'CPF não pode conter mais que 14 caracteres.',
            'idade.max' => 'Idade não pode conter mais que 3 caracteres.',
            'telefone.max' => 'Telefone não pode conter mais que 14 caracteres.'
        ];
    }
}
