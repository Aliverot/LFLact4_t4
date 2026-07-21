<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;
use App\Http\Resources\VideojuegoResource;

class VideojuegoController extends Controller
{
    // GET: Listar todos con paginación
    public function index()
    {
        $videojuegos = Videojuego::paginate(5);
        return VideojuegoResource::collection($videojuegos);
    }

    // POST: Crear un nuevo registro
    public function store(Request $request)
    {
        // Validamos los datos de entrada (Si falla, Laravel devuelve error 422 automáticamente)
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

    // GET: Ver un solo registro
    public function show(Videojuego $videojuego)
    {
        return new VideojuegoResource($videojuego);
    }

    // PUT/PATCH: Actualizar un registro
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

    // DELETE: Eliminar un registro
    public function destroy(Videojuego $videojuego)
    {
        $videojuego->delete();

        // 204 significa "No Content" (Se eliminó correctamente y no hay nada que devolver)
        return response()->json(null, 204);
    }
}