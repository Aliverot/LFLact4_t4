<?php
// 1. Importaciones: Carga de herramientas base y controladores necesarios.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideojuegoController;

// 2. Rutas Públicas: Abiertas a cualquier usuario para registrarse u obtener su token.
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 3. Filtro de Seguridad: Bloquea el acceso a las rutas internas si no hay un token válido.
Route::middleware('auth:sanctum')->group(function () {

    // 4. CRUD Automático: Genera en una línea las 5 acciones protegidas para gestionar videojuegos.
    Route::apiResource('videojuegos', VideojuegoController::class);
    
    // 5. Consulta de Identidad: Retorna la información del usuario que inició sesión.
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});