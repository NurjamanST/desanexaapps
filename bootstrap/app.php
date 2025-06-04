<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Roles
use App\Http\Middleware\KepdesaMiddleware;
use App\Http\Middleware\PendudukMiddleware;
use App\Http\Middleware\AdminappsMiddleware;
use App\Http\Middleware\StaffdesaMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "adminapps" => AdminappsMiddleware::class,
            "kepdesa" => KepdesaMiddleware::class,
            "penduduk" => PendudukMiddleware::class,
            "staffdesa" => StaffdesaMiddleware::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
