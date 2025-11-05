<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Http\Request;

class ApiAuthenticate extends BaseAuthenticate
{
    /**
     * Override redirect behaviour for unauthenticated requests.
     *
     * Returning null stops the framework from trying to call
     * route('login') and forces a 401 response instead.
     */
    protected function redirectTo(Request $request): ?string
    {
        return null;
    }
}
