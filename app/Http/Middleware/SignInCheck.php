<?php

namespace App\Http\Middleware;

use Closure;

class SignInCheck
{
    public function handle($request, Closure $next)
    {
        if (session()->has('user_id')) {
            return redirect()->route('home')->with('message', 'already login');
        }
        return $next($request);
    }
}
