<?php

namespace App\Providers;

// Dua baris ini untuk Gate
use Illuminate\Support\Facades\Gate; 
use App\Models\User; 

// Tambahkan baris ini untuk menangani URL HTTPS
use Illuminate\Support\Facades\URL; 
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Memaksa skema URL ke HTTPS jika aplikasi berada di lingkungan production (Railway).
         * Ini akan memperbaiki error "Mixed Content" pada CSS/JS Anda.
         */
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Logika Gate Anda tetap di sini
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('karyawan-only', function (User $user) {
            return $user->role === 'karyawan';
        });
    }
}