<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BibliotecaUsuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class BibliotecaUsuariosController extends Controller
{

    public function index(): JsonResponse
    {
        $bibliotecas = BibliotecaUsuario::all();

        return response()->json([
            'status' => 'success',
            'data' => $bibliotecas
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_videojuego' => 'required|exists:videojuegos,id_videojuego',
            'estado_juego' => 'sometimes|in:sin_jugar,jugando,completado,pausado',
            'horas_jugadas' => 'sometimes|numeric|min:0',
            'fecha_compra' => 'sometimes|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $validated = $validator->validated();
            $validated['fecha_compra'] = $validated['fecha_compra'] ?? now();


            $bibliotecaUsuario = BibliotecaUsuario::create($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Entrada en la biblioteca creada con exito',
                'data' => $bibliotecaUsuario
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la entrada en la bilioteca.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        $bibliotecaUsuario = BibliotecaUsuario::with(['usuario', 'videojuego'])->find($id);

        if (!$bibliotecaUsuario) {
            return response()->json([
                'status' => 'error',
                'message' => 'Entrada en biblioteca no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $bibliotecaUsuario
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $bibliotecaUsuario = BibliotecaUsuario::find($id);

        if (!$bibliotecaUsuario) {
            return response()->json([
                'status' => 'error',
                'message' => 'Entrada en la biblioteca no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'estado_juego' => 'sometimes|in:sin_jugar,jugando,completado,pausado',
            'horas_jugadas' => 'sometimes|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $bibliotecaUsuario->update($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Entrada en la biblioteca actualizada con exito',
                'data' => $bibliotecaUsuario
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar la entrada en la biblioteca',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        $bibliotecaUsuario = BibliotecaUsuario::find($id);

        if (!$bibliotecaUsuario) {
            return response()->json([
                'status' => 'error',
                'message' => 'Entrada en la biblioteca no encontrada'
            ], 404);
        }

        try {
            $bibliotecaUsuario->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Entrada en la biblioteca eliminada con exito'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar la entrada en la biblioteca',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
