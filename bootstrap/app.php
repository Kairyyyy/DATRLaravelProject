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
        // Register middleware aliases
        $middleware->alias([
            'verified.admin' => \App\Http\Middleware\EnsureAdminEmailIsVerified::class,
        ]);
        
        // Redirect guests based on route prefix
        $middleware->redirectGuestsTo(function($request){
            if ($request->is('admin/*')){
                return route('admin.login');
            } 
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();