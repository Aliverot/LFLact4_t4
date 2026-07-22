<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideojuegoResource extends JsonResource
{
    // 1. El filtro de presentación (Maquillaje de datos)
    // Este método decide exactamente qué piezas de información verá el usuario en su pantalla.
    // Lo que NO pongas en esta lista (como las fechas 'created_at' o 'updated_at' de la base de datos), 
    // simplemente se omite. Así mantienes tu JSON limpio y ocultas datos internos.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'desarrollador' => $this->desarrollador,
            'descripcion' => $this->descripcion,
            'motor_grafico' => $this->motor_grafico,
            
            // 2. Corrección de formato estricto
            // Al poner (float), obligas a que el peso se envíe como un número matemático real (ej. 45.5).
            // Esto evita el error común donde MySQL a veces envía los números disfrazados de texto ("45.5").
            'peso_gb' => (float) $this->peso_gb,
        ];
    }
}