<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        Log::info($user);

        if (!$user || $user->role !== $role) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
