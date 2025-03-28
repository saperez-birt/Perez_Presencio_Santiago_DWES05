<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;



class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        $usuarios = Usuario::all();

        return response()->json([
            'status' => 'success',
            'data' => $usuarios
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:usuarios,username|max:50',
            'nombre' => 'required|max:100',
            'apellidos' => 'required|max:150',
            'email' => 'required|email|unique:usuarios,email|max:150',
            'fecha_nacimiento' => 'nullable|date',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }
        
        try {
            $validated = $validator->validated();
            $validated['ultima_conexion'] = now();

            $usuario = Usuario::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario creado con exito',
                'data' => $usuario
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el usuario.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $usuario
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|unique:usuarios,username|max:50',
            'nombre' => 'sometimes|max:100',
            'apellidos' => 'sometimes|max:150',
            'email' => 'sometimes|email|unique:usuarios,email|max:150',
            'fecha_nacimiento' => 'nullable|date',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $validated = $validator->validated();
            $validated['ultima_conexion'] = now();

            $usuario->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario actualizado con exito',
                'data' => $usuario
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el usuario.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        try {
            $usuario->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario eliminado con exito',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el usuario.',
                'details' => $e->getMessage()
            ], 500);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
