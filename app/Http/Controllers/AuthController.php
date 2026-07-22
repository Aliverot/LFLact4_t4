<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Método para registrar un nuevo usuario
    public function register(Request $request)
    {
        // 1. Filtro inicial: Revisa que envíen nombre, un correo válido/único y una contraseña segura.
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // 2. Creación: Guarda al usuario en la base de datos y encripta su contraseña por seguridad.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Llave de acceso: Le genera su primer token para que pueda usar el sistema de inmediato.
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Entrega: Devuelve un mensaje de éxito junto con la llave (token) recién creada.
        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    // Método para iniciar sesión
    public function login(Request $request)
    {
        // 1. Filtro inicial: Exige que envíen correo y contraseña.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Búsqueda: Busca el correo ingresado en la base de datos.
        $user = User::where('email', $request->email)->first();

        // 3. Verificación de seguridad: Si el correo no existe o la contraseña no coincide, bloquea el paso.
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // 4. Llave de acceso: Si pasó la prueba de seguridad, le genera un nuevo token válido.
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Entrega: Devuelve el token para que el usuario pueda usar las rutas protegidas.
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}