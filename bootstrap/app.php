<?php

use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\EmpApiAuth;
use App\Http\Middleware\EmpAuthCheck;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 
        $middleware->appendToGroup('auth', [AuthCheck::class]);
        $middleware->appendToGroup('emp.auth', [EmpAuthCheck::class]);
        $middleware->appendToGroup('api.emp.auth', [EmpApiAuth::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
