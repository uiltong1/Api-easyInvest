<?php

namespace App\Http\Requests\Despesa;

use Illuminate\Foundation\Http\FormRequest;

class DespesaFormRequest extends FormRequest
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
            'idusuario'=>'required',
            'nmdespesa'=>'min:4|max:30',
            'descricao'=>'min:0|max:256',
            'valor'=>'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
    public function messages(){
        return[
         'idusuario.required'=>'Informe o id do usuário',
         'nmdespesa.min'=>'Nome da despesa não pode conter menos que 4 caracteres.',
         'nmdespesa.max'=>'Nome da despesa não pode conter mais que 30 caracteres.',
         'descricao.max'=> 'Descrição não pode conter mais que 256 caracteres.',
         'valor.required'=>'Valor da despesa não pode ser nulo.',
         'valor.numeric'=>'Valor da despesa não pode conter letras ou caracteres especiais.',
         'valor.regex'=>'Valor da despesa não pode conter letras ou caracteres especiais.'
        ];
    }
}
