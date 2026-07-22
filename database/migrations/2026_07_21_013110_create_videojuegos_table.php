<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear la tabla (up)
     */
    public function up(): void
    {
        // Define la estructura de la tabla "videojuegos" en la base de datos
        Schema::create('videojuegos', function (Blueprint $table) {
            $table->id();                                    // ID único autoincrementable
            $table->string('titulo');                        // Título del juego (Obligatorio)
            $table->string('desarrollador');                 // Estudio o creador (Obligatorio)
            $table->text('descripcion')->nullable();         // Resumen o descripción (Opcional)
            $table->string('motor_grafico')->nullable();     // ej. Unreal Engine, Unity (Opcional)
            $table->decimal('peso_gb', 8, 2)->nullable();   // Tamaño en GB con 2 decimales (Opcional)
            $table->timestamps();                            // Fechas automáticas de creación y edición
        });
    }

    /**
     * Eliminar la tabla (down)
     */
    public function down(): void
    {
        // Borra la tabla por completo si se revierte la migración
        Schema::dropIfExists('videojuegos');
    }
};