<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Investimento\InvestimentoFormRequest;
use App\Model\Investimento;
use Exception;
use Illuminate\Support\Facades\DB;

class InvestimentoController extends Controller
{
    public function index()
    {
        try {
            $investimento = Investimento::all();

            if (count($investimento) == 0):
                return response()->json(['message' => 'Nenhum Registro Encontrado.']);
            endif;
            return response()->json($investimento);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function create(InvestimentoFormRequest $request)
    {
        try {
            $investimento = new Investimento;
            $investimento->idusuario = $request->idusuario;
            $investimento->nminvestimento = $request->nminvestimento;
            $investimento->descricao = $request->descricao;
            $investimento->data = $request->data;
            $investimento->valor = $request->valor;
            $investimento->status = 1;
            $investimento->save();
            return response()->json(['message' => 'Investimento registrada com êxito!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function update(InvestimentoFormRequest $request, $id)
    {
        try {
            $investimento = new Investimento;
            $dados = $request->all();
            $investimento = $investimento->find($id);
            $update = $investimento->update($dados);
            if ($update):
                return response()->json(['message' => 'Investimento atualizada com êxito!']);
            else:
                return response()->json(['message' => 'Os dados não foram atualizados!']);
            endif;
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function destroy($id)
    {
        try {
            $investimento = new Investimento;
            $delete = $investimento->where('id', $id)->delete();
            if ($delete):
                return response()->json(['message' => "Investimento N° $id foi excluída com sucesso!"]);
            else:
                return response()->json(['message' => "Registro de Nº $id não existe!"]);
            endif;
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function selectInvestimentos($idusuario)
    {
        try {
            $dados = DB::table('investimento')->select('*', DB::raw("format(valor,2,'de_DE') AS valor"))->where([['idusuario', '=', $idusuario], ['status', '=', 1]])->get();
            if (count($dados) != 0):
                return response()->json($dados);
            else:
                return response()->json(["message" => "Nenhum registro encontrado."]);
            endif;
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function selectInvestimento($id, $idusuario)
    {
        try {
            $dados = DB::table('investimento')->select('*', DB::raw("format(valor,2,'de_DE') AS valor"))->where([['id', '=', $id], ['idusuario', '=', $idusuario], ['status', '=', 1]])->get();
            if (count($dados) != 0):
                return response()->json($dados);
            endif;
            return response()->json(["message" => "Não foi encontrada investimento com nº $id"]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function logicDelete($id)
    {
        try {
            $update = DB::table('investimento')->where('id', $id)->update(array('status' => 0));
            if ($update):
                return response()->json(["message" => "Investimento nº $id excluída com sucesso!"]);
            endif;
            return response()->json(["message" => "Investimento nº $id não foi encontrada!"]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function investimentoPeriodo($idusuario, $de, $ate)
    {
        try {
            $dados = DB::table('investimento')
                ->where([['idusuario','=', $idusuario], ['status', '=',1]])
                ->whereBetween('data', [$de, $ate])
                ->get();
            if (count($dados) != 0):
                return response()->json($dados);
            endif;
            return response()->json(["message" => "Nenhum registro encontrado."]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function totalInvestimento($idusuario)
    {
        try {
            $dados = DB::table('investimento')
                ->select(DB::raw("format(sum(valor),2,'de_DE') AS valor"))
                ->where([['idusuario', '=', $idusuario], ['status', '=', 1]])
                ->get();
            if (count($dados) != 0):
                return response()->json($dados[0]);
            endif;
            return response()->json(["message" => "Nenhum registro encontrado."]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function totalInvestimentoPeriodo($idusuario, $de, $ate)
    {
        try {
            $dados = DB::table('investimento')
                ->select(DB::raw("format(sum(valor),2,'de_DE') AS valor"))
                ->where([['idusuario', '=', $idusuario], ['status', '=', 1]])
                ->whereBetween('data', [$de, $ate])
                ->get();
            if (count($dados) != 0):
                return response()->json($dados[0]);
            endif;
            return response()->json(["message" => "Nenhum registro encontrado."]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
}
