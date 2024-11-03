<?php

use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\MerchantEnsureEmailIsVerified;
use App\Http\Middleware\MerchantMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as MiddlewareEnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as MiddlewareRedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(replace: [
            RedirectIfAuthenticated::class => MiddlewareRedirectIfAuthenticated::class,
            // EnsureEmailIsVerified::class => MiddlewareEnsureEmailIsVerified::class
        ]);
        // $middleware->web(append: [
        //     MerchantEnsureEmailIsVerified::class
        // ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
