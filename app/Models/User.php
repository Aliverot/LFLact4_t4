<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    // HasApiTokens: Permite al usuario generar y usar llaves de seguridad (tokens).
    use HasFactory, Notifiable, HasApiTokens;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // Por seguridad, solo estos campos se pueden guardar o editar de golpe.
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    // Estos datos jamás se mostrarán cuando la API devuelva la información del usuario.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // Convierte datos automáticamente. Aquí asegura que la contraseña siempre se encripte.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
