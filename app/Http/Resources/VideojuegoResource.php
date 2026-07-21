<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideojuegoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Aquí "maquillamos" cómo queremos que se vea el JSON de salida
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'desarrollador' => $this->desarrollador,
            'descripcion' => $this->descripcion,
            'motor_grafico' => $this->motor_grafico,
            'peso_gb' => (float) $this->peso_gb,
        ];
    }
}