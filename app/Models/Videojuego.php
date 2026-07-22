<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    use HasFactory;

    // Define exactamente qué columnas permitimos que se llenen o editen de golpe. 
    // Si un usuario malintencionado intenta enviar un dato extra que no está en esta lista 
    // (por ejemplo, intentar modificar su ID), el sistema simplemente lo ignora.
    protected $fillable = [
        'titulo',
        'desarrollador',
        'descripcion',
        'motor_grafico',
        'peso_gb'
    ];
}