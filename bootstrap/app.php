<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\EnsureUserHasRole;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        // Custom Role Middleware Alias
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
        ]);

        // Redirect Guest Users to Login
        $middleware->redirectGuestsTo('/login');

        // Redirect Authenticated Users According to Role
        $middleware->redirectUsersTo(function (Request $request) {

            $user = $request->user();

            if (!$user) {
                return '/login';
            }

            return match ($user->role) {

                'admin' => '/admin/dashboard',

                'teacher' => '/teacher/dashboard',

                'student' => '/student/dashboard',

                default => '/login',

            };
        });

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) =>
                $request->is('api/*') || $request->expectsJson(),
        );

    })->create();