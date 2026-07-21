<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideojuegoController;

// Rutas Públicas (No requieren token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas Protegidas (SÍ requieren token)
Route::middleware('auth:sanctum')->group(function () {
    // Esto crea las 5 rutas del CRUD (index, store, show, update, destroy) automáticamente
    Route::apiResource('videojuegos', VideojuegoController::class);
    
    // Ruta por defecto para ver tu usuario
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});