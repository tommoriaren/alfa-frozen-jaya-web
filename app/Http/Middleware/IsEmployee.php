<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsEmployee
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
        
            // Cek apakah role-nya 'karyawan' atau 'admin' 
            // (Admin diberi akses agar bisa tes fitur)
            if ($user->role === 'karyawan' || $user->role === 'admin') {
                return $next($request);
            }
        }

        return redirect()->route('home')->with('error', 'Hanya Karyawan yang dapat mengakses halaman ini.');
    }
}