<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuarios::with(['resort', 'nivel'])->get();
        return response()->json($usuarios);
    }

    public function show($id)
    {
        $usuario = Usuarios::with(['resort', 'nivel'])->find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'id_resort' => 'required|exists:resorts,id',
            'id_nivel' => 'required|exists:niveles,id',
            'contrasena' => 'required',
        ]);

        $hashedPassword = Hash::make($request->input('contrasena'));

        $usuario = Usuarios::create([
            'usuario' => $request->input('usuario'),
            'id_resort' => $request->input('id_resort'),
            'id_nivel' => $request->input('id_nivel'),
            'contrasena' => $hashedPassword,
        ]);

        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'usuario' => 'required',
            'id_resort' => 'required|exists:resorts,id',
            'id_nivel' => 'required|exists:niveles,id',
            'contrasena' => 'required',
        ]);

        $usuario->update($request->all());

        return response()->json($usuario);
    }

    public function destroy($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['mensaje' => 'Usuario eliminado correctamente']);
    }

    public function login(LoginFormRequest $request)
    {
        $credentials = $request->validated();

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        return response()->json(['access_token' => $token]);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['mensaje' => 'Sesión cerrada correctamente']);
    }
}
