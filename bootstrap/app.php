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
    ->withMiddleware(function (Middleware $middleware): void {
        
        // [PENTING] Matikan CSRF khusus untuk route Midtrans
        // Agar Midtrans bisa mengirim laporan status bayar tanpa diblokir
        $middleware->validateCsrfTokens(except: [
            'midtrans/callback', 
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();