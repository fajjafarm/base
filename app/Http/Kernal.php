<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ...

    protected $routeMiddleware = [
        // Existing middleware...
        'auth' => \App\Http\Middleware\Authenticate::class,
        'superadmin' => \App\Http\Middleware\SuperAdminOnly::class, // Add this line
    ];

    // ...
}