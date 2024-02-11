<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    // TODO: Add this urls only for test
    protected $except = [
        '/login',
        '/register',
        'confirm-password',
        'forgot-password',
        '/profile',
        '/password'
    ];
}
