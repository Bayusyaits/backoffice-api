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
     * @var array
     */
    protected $middleware = [
        //handling cors https://github.com/barryvdh/laravel-cors/issues/89
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Barryvdh\Cors\HandleCors::class,
        //89
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,        
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Barryvdh\Cors\HandleCors::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // Other middleware...
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
        'firewall' => [
            \PragmaRX\Firewall\Middleware\FirewallBlacklist::class,
            \PragmaRX\Firewall\Middleware\BlockAttacks::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt-auth' => \App\Http\Middleware\AuthJWT::class,
        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,
        'cors' => \App\Http\Middleware\Cors::class, // <<< add this line
        /*  
            * passport
            * https://laravel.com/docs/5.6/passport
        */
        'client' => CheckClientCredentials::class,
        'scopes' => \Laravel\Passport\Http\Middleware\CheckScopes::class,
        'scope' => \Laravel\Passport\Http\Middleware\CheckForAnyScope::class,
        //pregmarx firewall ip
        'fw-only-whitelisted' => \PragmaRX\Firewall\Middleware\FirewallWhitelist::class,
        'fw-block-blacklisted' => \PragmaRX\Firewall\Middleware\FirewallBlacklist::class,
        'fw-block-attacks' => \PragmaRX\Firewall\Middleware\BlockAttacks::class,
    ];
}
