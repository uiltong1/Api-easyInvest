<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pessoa\PessoaFormRequest;
use App\Model\Pessoa;
use Exception;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\ExceptionMessage;

class PessoaController extends Controller
{

    public function index()
    {
        return Pessoa::all();
    }

    public function create(PessoaFormRequest $request)
    {
        try {
            $pessoa = new Pessoa;
            $pessoa->id = $request->id;
            $pessoa->cpf = $request->cpf;
            $pessoa->idade = $request->idade;
            $pessoa->telefone = $request->telefone;
            $pessoa->save();
            return response()->json(['message' => 'Dados registrados com êxito!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'cpf' => 'required|cpf|formato_cpf|max: 14',
            ]);
            $pessoa = new Pessoa;
            $dados = $request->all();
            $pessoa = $pessoa->find($id);
            $update = $pessoa->update($dados);
            if ($update):
                return response()->json(['message' => 'Dados atualizados com êxito!']);
            else:
                return response()->json(['message' => 'Os dados não foram atualizados!']);
            endif;
        } catch (ExceptionMessage $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function destroy($id)
    {
        try {
            $pessoa = new Pessoa;
            $delete = $pessoa->where('id', $id)->delete();
            if ($delete):
                return response()->json(['message' => 'Dados excluídos com êxito!']);
            else:
                return response()->json(['message' => 'Os dados não foram excluídos!']);
            endif;
        } catch (ExceptionMessage $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
}
