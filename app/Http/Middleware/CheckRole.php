<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            if (Auth::check() && Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak! Halaman tersebut khusus pelanggan.');
            }

            return redirect()->route('home')->with('error', 'Akses ditolak! Anda tidak memiliki izin membuka halaman Admin.');
        }

        return $next($request);
    }
}
