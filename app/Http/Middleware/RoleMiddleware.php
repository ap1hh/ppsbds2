<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login dan role-nya sesuai dengan yang diminta rute
        if ($request->user() && $request->user()->role !== $role) {
            // Jika tidak sesuai, tendang ke halaman 403 (Akses Ditolak)
            abort(403, 'Maaf, Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}