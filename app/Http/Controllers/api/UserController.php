<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\api\PessoaController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pessoa\PessoaFormRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserFormRequest;
use App\Model\Pessoa;

class UserController extends Controller
{
    //
    public function listar()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function registerUser(UserFormRequest $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'Salvo com sucesso!']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao tentar tentar conectar com o servidor de banco de dados.', 'error' => $e]);
        }
    }
}
