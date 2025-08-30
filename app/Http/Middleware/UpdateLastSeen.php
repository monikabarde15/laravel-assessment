<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
    $response = $next($request);
    if ($user = auth()->user()) {
    $user->forceFill(['last_seen_at' => now()])->saveQuietly();
    }
    return $response;
    }
}
