<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Memperbaiki masalah HTTPS/Mixed Content
        $middleware->trustProxies(at: '*');

        // 2. Mendaftarkan Middleware Custom Anda (Alias)
        // Mendaftarkan alias middleware agar bisa digunakan di routes/web.php
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'employee' => \App\Http\Middleware\IsEmployee::class,
        ]);

        // Jika Anda ingin mengalihkan user setelah login ke /dashboard
        // Anda bisa mengaturnya melalui middleware redirect
        $middleware->redirectTo(
            guests: '/internal/login',
            users: '/dashboard'
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();                                                                                                                                                                                                                                                                                                                                                                                                                                                                   