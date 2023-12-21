<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Email ou senha inválidos'], 401);
        }

        // Get user details from database - verificando usuário no banco.
        $user = User::where('email', $request->email)->first();

        // Implementação futura: bloqueio de usuario.
        // Implementação futura: verificações de usuário aluno e pergunta aluno com retorno apropriado.

        // Return JSON data for user details - retorno JSON com dados do usuário.
        return response()->json([
            'message' => 'Logado com sucesso',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'level' => $user->level
            ]
        ]);
    }

    // Implementação futura: retorno com campos necessários para pergunta de aluno.
    public function me()
    {
        return response()->json(auth()->user());
    }

    //gera o token por meio de usuario(no caso email) e senha
    //cliente armazena
    //cliente precisa implementar no headers: Key:Authorization, Value Bearer token gerado


    // Funções que não estão em uso no momento

    // public function loginToken(Request $request) {

    //     $credenciais = $request->all(['email', 'password']);

    //     //autenticacao (email e senha)

    //     $token = auth('api')->attempt($credenciais);

    //     //usuario autenticado com sucesso
    //     if($token) {
    //         return response()->json(['token' => $token]);
    //         //erro de usuario ou senha
    //     } else {
    //         return response()->json(['erro' => 'Usuaário ou senha inválido!'], 403);
    //     }
    //     //403 = forbidden -> proibido (login invalido)
    // }

    // public function logout() {
    //     auth('api')->logout(); //cliente encaminhe um jwt valido
    //     return response()->json(['msg' => 'Logout realizado com sucesso!']);
    // }

    // public function refresh() {
    //     $token = auth('api')->refresh(); //cliente encaminhe um jwt valido
    //     return response()->json(['token' => $token]);
    // }

}
