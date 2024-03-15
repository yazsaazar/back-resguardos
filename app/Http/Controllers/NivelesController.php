<?php

namespace App\Http\Controllers;

use App\Models\Niveles;
use Illuminate\Http\Request;

class NivelesController extends Controller
{
    /**
     * Muestra todos los niveles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $niveles = Niveles::all();
        return response()->json($niveles);
    }

    /**
     * Muestra un nivel específico por su ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $nivel = Niveles::find($id);

        if (!$nivel) {
            return response()->json(['error' => 'Nivel no encontrado'], 404);
        }

        return response()->json($nivel);
    }

    /**
     * Crea un nuevo nivel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nivel' => 'required',
            'nombre' => 'required',
        ]);

        $nivel = Niveles::create($request->all());

        return response()->json($nivel, 201);
    }

    /**
     * Actualiza un nivel existente por su ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $nivel = Niveles::find($id);

        if (!$nivel) {
            return response()->json(['error' => 'Nivel no encontrado'], 404);
        }

        $request->validate([
            'nivel' => 'required',
            'nombre' => 'required',
        ]);

        $nivel->update($request->all());

        return response()->json($nivel);
    }

    /**
     * Elimina un nivel por su ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $nivel = Niveles::find($id);

        if (!$nivel) {
            return response()->json(['error' => 'Nivel no encontrado'], 404);
        }

        $nivel->delete();

        return response()->json(['mensaje' => 'Nivel eliminado correctamente']);
    }
}
