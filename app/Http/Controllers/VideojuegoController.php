<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;
use App\Http\Resources\VideojuegoResource;

class VideojuegoController extends Controller
{
    // 1. Mostrar Lista (GET)
    // Trae los videojuegos de la base de datos de 5 en 5 (paginación).
    // Los pasa por el "Resource" para entregar la información en un formato JSON limpio.
    public function index()
    {
        $videojuegos = Videojuego::paginate(5);
        return VideojuegoResource::collection($videojuegos);
    }

    // 2. Crear Registro (POST)
    // Revisa que los datos enviados cumplan las reglas (ej. que el título no esté vacío).
    // Si aprueban, guarda el juego y responde con un código 201 (Elemento Creado).
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'desarrollador' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'motor_grafico' => 'nullable|string|max:255',
            'peso_gb' => 'nullable|numeric|min:0',
        ]);

        $videojuego = Videojuego::create($validated);
        
        return response()->json(new VideojuegoResource($videojuego), 201);
    }

    // 3. Ver Detalles de Uno Solo (GET)
    // Busca automáticamente el juego por su ID y devuelve sus datos pasados por el filtro de presentación.
    public function show(Videojuego $videojuego)
    {
        return new VideojuegoResource($videojuego);
    }

    // 4. Actualizar Registro (PUT/PATCH)
    // La regla 'sometimes' es clave: significa que solo verificará y actualizará los campos 
    // que decidas enviarle en ese momento, sin obligarte a rellenar todo el formulario de nuevo.
    public function update(Request $request, Videojuego $videojuego)
    {
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'desarrollador' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'motor_grafico' => 'nullable|string|max:255',
            'peso_gb' => 'nullable|numeric|min:0',
        ]);

        $videojuego->update($validated);

        return new VideojuegoResource($videojuego);
    }

    // 5. Eliminar Registro (DELETE)
    // Borra el juego de la base de datos.
    // El código 204 significa "Operación exitosa, no hay contenido que mostrar de vuelta".
    public function destroy(Videojuego $videojuego)
    {
        $videojuego->delete();

        return response()->json(null, 204);
    }
}