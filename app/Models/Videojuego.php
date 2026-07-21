<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    use HasFactory;

    // Aquí le decimos a Laravel qué campos son seguros para recibir datos
    protected $fillable = [
        'titulo',
        'desarrollador',
        'descripcion',
        'motor_grafico',
        'peso_gb'
    ];
}