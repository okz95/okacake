<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            // Jika belum login, redirect ke halaman login
            Alert::error('error', 'Silakan login terlebih dahulu.');
            return redirect('/auth/login');
        }

        // 2. Ambil role user
        $userRole = Auth::user()->role;

        // 3. Cek apakah role user termasuk dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Opsional: bisa log percobaan akses ilegal
            // \Log::warning("User ID {$request->user()->id} mencoba mengakses route '{$request->path()}' tanpa izin.");

            // Redirect ke dashboard atau halaman error
            Alert::warning('Peringatan!', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect('/');
        }

        // 4. Jika lolos pengecekan, lanjutkan request
        return $next($request);
    }
}
