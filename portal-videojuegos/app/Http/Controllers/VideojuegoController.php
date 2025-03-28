<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Videojuego;

class VideojuegoController extends Controller
{
    public function index(): JsonResponse
    {
        $videojuegos = Videojuego::all();

        return response()->json([
            'status' => 'success',
            'data' => $videojuegos
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100|unique:videojuegos,nombre',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'fecha_lanzamiento' => 'nullable|date',
            'clasificacion' => 'required|in:E,E10+,T,M,AO'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $videojuego = Videojuego::create($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Videojuego creado con exito',
                'data' => $videojuego
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el videojuego.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        $videojuego = Videojuego::find($id);

        if (!$videojuego) {
            return response()->json([
                'status' => 'error',
                'message' => 'Videojuego no encontrado',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $videojuego
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $videojuego = Videojuego::find($id);

        if (!$videojuego) {
            return response()->json([
                'status' => 'error',
                'message' => 'Videojuego no encontrado',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:100|unique:videojuegos,nombre',
            'descripcion' => 'nullable|string',
            'precio' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'fecha_lanzamiento' => 'nullable|date',
            'clasificacion' => 'sometimes|in:E,E10+,T,M,AO'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }
    
        try {
            $videojuego->update($validator->validated());

            return response()->json([
                'status' => 'succes',
                'message' => 'Videojuego actualizado con exito',
                'data' => $videojuego
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el videojuego.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        $videojuego = Videojuego::find($id);

        if (!$videojuego) {
            return response()->json([
                'status' => 'error',
                'message' => 'Videojuego no encontrado',
            ], 404);
        }

        try {
            $videojuego->delete();

            return response()->json([
                'status' => 'succes',
                'message' => 'Videojuego eliminado con exito',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el videojuego.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
