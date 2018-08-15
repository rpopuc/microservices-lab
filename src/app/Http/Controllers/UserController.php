<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Obtém a lista dos usuários cadastrados
     *
     * @api {get} /user        Obtém lista de usuários registrados
     * @apiName  GetUsers
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiSuccess {Array} user Lista de usuários
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Armazena as informações de um usuário
     *
     * @api {post} /user        Armezana dados de um usuário
     * @apiName  PostUser
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiParam {String} name   Nome do usuário.
     * @apiParam {String} email  Email do usuário.
     * @apiParam {String} password  Senha do usuário.
     *
     * @apiSuccess {Integer} id Identificador do usuário.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "name": "John",
     *       "email": "john@doe.com"
     *     }
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ], [
            'name.required' => 'Name deve ser preenchido',
            'email.required' => 'Email deve ser preenchido',
            'email.unique' => 'Email já cadastrado',
            'email.email' => 'Email inválido',
            'password.required' => 'Senha deve ser informada',
        ]);

        try {
            $user = new User($request->all());
            $user->password = Hash::make($request->get('password'));
            $user->save();

            return response()->json(['id' => $user->hash], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Obtém as informações de um usuário
     *
     * @api {get} /user/:id        Obtém os dados de um usuário
     * @apiName  GetUser
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id  Identificador do usuário.
     *
     * @apiSuccess {Usuario} usuario  Dados do usuário
     */
    public function show(Request $request, $userId)
    {
        $user = User::find($userId);
        if ($user) {
            return $user;
        }
        return response()->json([
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Atualiza as informações de um usuário
     *
     * @api {get} /user/:id        Atualiza os dados de um usuário
     * @apiName  UpdateUser
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiParam {Number} id  Identificador do usuário.
     *
     * @apiSuccess {Number} id  Identificador do usuário.
     */
    public function update(Request $request, $userId)
    {
        $user = User::find($userId);
        //$user = User::where('hash', $userId)->first();
        if ($user) {
            $user->fill($request->all());
            $user->save();
            return response()->json([
                'id' => $user->id,
                'url' => route('user.update', ['userId' => $user->id])
            ]);
        }
        return response()->json([
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Exclui as informações de um determinado usuário
     *
     * @api {post} /user        Exclui as informações do usuário
     * @apiName  DeleteUser
     * @apiGroup User
     * @apiVersion 1.0.0
     *
     * @apiParam {String} id     Identificador do usuário
    *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "ok": true,
     *     }
     */
    public function delete(Request $request, $userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
        }
        return response()->json(['ok' => true], Response::HTTP_OK);
    }
}
