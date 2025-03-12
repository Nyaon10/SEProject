<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth.middleware' => \App\Http\Middleware\AuthenticationMiddleware::class,
        'auth.role' => \App\Http\Middleware\AuthorizationMiddleware::class,
        'blacklist' => \App\Http\Middleware\BlacklistCheckMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'order.ownership' => \App\Http\Middleware\OrderOwnershipMiddleware::class,
        'payment.verified' => \App\Http\Middleware\PaymentVerificationMiddleware::class,
        'rental.return' => \App\Http\Middleware\RentalReturnMiddleware::class,
        'review.allowed' => \App\Http\Middleware\ReviewMiddleware::class,
        'validate.data' => \App\Http\Middleware\DataValidationMiddleware::class,
    ];
}
