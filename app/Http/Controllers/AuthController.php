<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where(['email' => $email, 'password' => $password])->first();

        if (!$user) {
            return new JsonResponse(['error' => 'Credenciales invalidas'], 400);
        }

        $token = $this->generateToken($user);

        return new JsonResponse(['token' => $token]);
    }

    public function logout()
    {
        auth()->logout();
        
        return response()->json(['message' => 'Sesión cerrada con éxito']);
    }

    private function generateToken(User $user)
    {
        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + 3600,
        ];

        $token = JWT::encode($payload, config('services.JWT.key'), 'HS256');

        return $token;
    }
}
