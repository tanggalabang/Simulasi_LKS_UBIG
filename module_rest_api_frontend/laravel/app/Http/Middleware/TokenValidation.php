<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->query('token');

        //check token
        if(!$token) return response()->json(['message' => 'Unauthorized'], 401);

        $actor = \App\Models\Actor::where('token', $token)->first();

        //check actor
        if(!$actor) return response()->json(['message' => 'Unauthorized'], 401);

        return $next($request);
    }
}
