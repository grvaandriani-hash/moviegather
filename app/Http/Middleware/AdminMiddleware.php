<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // ngecek user udh login
        // rolenya sebagai admin
        if (Auth::check() && Auth::user()->role == 'admin') {

            // klo benar, lanjutkan ke halaman yang dituju
            return $next($request);
        }

        // Jika bukan admin, tampilkan error 403 (Forbidden)
        abort(403, 'Akses ditolak.');
    }
}