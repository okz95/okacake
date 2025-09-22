<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // 1. Pastikan user sudah login
        if (!Auth::check()) {
            Alert::error('Error', 'Silakan login terlebih dahulu.');

            // Redirect ke halaman login
            return redirect()->route('auth.login');
        }

        return $next($request);

    }
}
