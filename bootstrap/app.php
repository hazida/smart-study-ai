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
        $middleware->alias([
            'session.auth' => \App\Http\Middleware\SessionAuth::class,
            'session.guest' => \App\Http\Middleware\SessionGuest::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'teacher.admin' => \App\Http\Middleware\TeacherAdminMiddleware::class,
            'parent' => \App\Http\Middleware\ParentMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
