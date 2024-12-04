<?php

namespace App\Http\Middleware;

use Closure;

class EmpAuthCheck
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('emp_id')) {
            return redirect()->route('app.signin')->with('message', 'Please log in first');
        }
        return $next($request);
    }
}
