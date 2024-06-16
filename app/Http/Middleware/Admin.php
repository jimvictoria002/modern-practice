<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has an 'admin' role
        if(!Auth::check()){
            return redirect('/')->with('error', 'Authentication is required.');
        }

        
        if (Auth::check() && Auth::user()->access == '1') {
            return $next($request);
        }

        // Optionally, redirect to a different page if not authorized
        return redirect('/dashboard')->with('error', 'You do not have admin access.');
    }
}
