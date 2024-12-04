<?php

namespace App\Http\Middleware;

use Closure;

class EmpSignInCheck
{
    public function handle($request, Closure $next)
    {
        if (session()->has('emp_id')) {
            return redirect()->route('app.home')->with('message', 'already login');
        }
        return $next($request);
    }
}
