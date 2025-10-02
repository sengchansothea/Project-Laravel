<?php

use App\Http\Middleware\CEOMiddleware;
use App\Http\Middleware\CFOMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\DepartmentAdminMiddleware;
use App\Http\Middleware\SystemAdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\HRManagerMiddleware;
use App\Http\Middleware\TeamLeaderMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'systemAdmin' => SystemAdminMiddleware::class,
            'deptAdmin'   => DepartmentAdminMiddleware::class,
            'CEO' => CEOMiddleware::class,
            'HR_manager' => HRManagerMiddleware::class,
            'CFO' => CFOMiddleware::class,
            'teamleader' => TeamLeaderMiddleware::class,
            'employee'  => EmployeeMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
