<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->bearerToken());
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Token no enviado'
            ], 400);
        }

        try {
            $decoded = JWT::decode($token, new Key(config('services.JWT.key'), 'HS256'));
            // $request->attributes->add(['user' => $decoded]);
        } catch (Exception $e) {
            return response()->json([
                // 'message' => $e->getMessage()
                 'message' => 'Token invalido'
            ], 401);
        }


        return $next($request);
    }
}
