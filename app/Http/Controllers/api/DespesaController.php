<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Despesa\DespesaFormRequest;
use App\Model\Despesa;
use Exception;
use Illuminate\Support\Facades\DB;

class DespesaController extends Controller
{
    public function index()
    {
        try {
            $depesas = Despesa::all();

            if (count($depesas) == 0):
                return response()->json(['message' => 'Nenhum Registro Encontrado.']);
            endif;
            return response()->json($depesas);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function create(DespesaFormRequest $request)
    {
        try {
            $despesa = new Despesa;
            $despesa->idusuario = $request->idusuario;
            $despesa->nmdespesa = $request->nmdespesa;
            $despesa->descricao = $request->descricao;
            $despesa->data = $request->data;
            $despesa->valor = $request->valor;
            $despesa->status = 1;
            $despesa->save();
            return response()->json(['message' => 'Despesa registrada com êxito!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function update(DespesaFormRequest $request, $id)
    {
        try {
            $despesa = new Despesa;
            $dados = $request->all();
            $despesa = $despesa->find($id);
            $update = $despesa->update($dados);
            if ($update):
                return response()->json(['message' => 'Despesa atualizada com êxito!']);
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
            $despesa = new Despesa;
            $delete = $despesa->where('id', $id)->delete();
            if ($delete):
                return response()->json(['message' => "Despesa N° $id foi excluída com sucesso!"]);
            else:
                return response()->json(['message' => "Registro de Nº $id não existe!"]);
            endif;
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function selectDespesas($idusuario)
    {
        try {
            $dados = DB::table('despesa')->select('*', DB::raw("format(valor,2,'de_DE') AS valor"))->where([['idusuario', '=', $idusuario], ['status', '=', 1]])->get();
            if (count($dados) != 0):
                return response()->json($dados);
            endif;
            return response()->json(["message" => "Nenhum registro encontrado."]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function selectDespesa($id, $idusuario)
    {
        try {
            $dados = DB::table('despesa')->select('*', DB::raw("format(valor,2,'de_DE') AS valor"))->where([['id', '=', $id], ['idusuario', '=', $idusuario], ['status', '=', 1]])->get();
            if (count($dados) != 0):
                return response()->json($dados);
            endif;
            return response()->json(["message" => "Não foi encontrada despesa com nº $id"]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function logicDelete($id)
    {
        try {
            $update = DB::table('despesa')->where('id', $id)->update(array('status' => 0));
            if ($update):
                return response()->json(["message" => "Despesa nº $id excluída com sucesso!"]);
            endif;
            return response()->json(["message" => "Despesa nº $id não foi encontrada!"]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
    public function despesaPeriodo($idusuario, $de, $ate)
    {
        try {
            $dados = DB::table('despesa')
                ->where([['idusuario', '=', $idusuario], ['status', '=', 1]])
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
    public function totalDespesa($idusuario)
    {
        try {
            $dados = DB::table('despesa')
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
    public function totalDespesaPeriodo($idusuario, $de, $ate)
    {
        try {
            $dados = DB::table('despesa')
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
