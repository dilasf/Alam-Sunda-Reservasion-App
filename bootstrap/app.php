<?php

use App\Http\Controllers\Admin\ReservasiController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Owner;
use App\Http\Middleware\Pelanggan;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => Admin::class,
            'owner' => Owner::class,
            'pelanggan' => Pelanggan::class,

        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->call(function () {
            (new ReservasiController)->checkAndUpdateStatus();
        })->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
