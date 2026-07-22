<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crea la tabla en la base de datos donde Sanctum guardará las llaves (tokens) de seguridad.
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); 
            
            // Relaciona el token con su dueño (guarda el ID del usuario al que le pertenece la llave).
            $table->morphs('tokenable');
            
            // Nombre para identificar dónde se creó el token (ej. "Postman", "Navegador Web").
            $table->text('name');
            
            // Guarda la llave de acceso en sí (el token encriptado).
            $table->string('token', 64)->unique();
            
            // Define qué permisos tiene este token.
            $table->text('abilities')->nullable();
            
            // Registra la fecha y hora exacta de la última vez que el usuario usó esta llave.
            $table->timestamp('last_used_at')->nullable();
            
            // Fecha límite de vida del token.
            $table->timestamp('expires_at')->nullable()->index();
            
            // Crea automáticamente las columnas de "fecha de creación" y "última actualización".
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina esta tabla por completo si decides revertir (deshacer) la base de datos.
        Schema::dropIfExists('personal_access_tokens');
    }
};