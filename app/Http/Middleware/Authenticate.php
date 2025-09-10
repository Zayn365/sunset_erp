<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // redirect unauthenticated web requests to login
        return $request->expectsJson() ? null : route('login');
    }
}
