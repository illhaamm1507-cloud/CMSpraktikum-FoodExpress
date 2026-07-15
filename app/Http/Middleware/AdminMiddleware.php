<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Belum login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Bukan admin
        if (Auth::user()->role != 'admin') {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
