<?php

use App\Http\Middleware\IdentifyStore;
use App\Http\Middleware\TransferCart;
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
        $middleware->append(IdentifyStore::class);
        $middleware->append(TransferCart::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
