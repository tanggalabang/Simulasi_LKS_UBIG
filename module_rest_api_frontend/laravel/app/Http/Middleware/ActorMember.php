<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActorMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');

        $actor = \App\Models\Actor::where('token', $token)->first();

        $boardMember = \App\Models\BoardMember::where('actor_id', $actor->id)->first();

        if(!$boardMember) return response()->json(['message' => 'Unauthorized only board team member can access'], 401);

        return $next($request);
    }
}
