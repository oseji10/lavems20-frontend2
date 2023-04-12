<?php
// app/Http/Middleware/AuthenticateToken.php

namespace App\Http\Middleware;

use Closure;

class AuthenticateToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('token');

        if (!$token) {
            return redirect('/login');
        }

        try {
            $payload = JWTAuth::getPayload($token);
        } catch (JWTException $e) {
            return redirect('/login');
        }

        $user = User::find($payload['sub']);

        if (!$user) {
            return redirect('/login');
        }

        $request->merge([
            'user' => $user
        ]);

        return $next($request);
    }
}
