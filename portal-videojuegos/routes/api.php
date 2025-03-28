<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\BibliotecaUsuariosController;

Route::middleware('api')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('videojuegos', VideojuegoController::class);
    Route::resource('biblioteca_usuarios', BibliotecaUsuariosController::class);
});

