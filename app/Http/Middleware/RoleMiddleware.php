<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // Pakai: ->middleware('role:admin') / 'role:petugas' / 'role:divisi' / 'role:admin,petugas'
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        if (!$user || (count($roles) && !in_array($user->role, $roles, true))) {
            abort(403, 'Anda tidak punya akses.');
        }
        return $next($request);
    }
}
