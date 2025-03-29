<?php
protected $routeMiddleware = [
    // Existing middleware...
    'superadmin' => \App\Http\Middleware\SuperAdminOnly::class,
];