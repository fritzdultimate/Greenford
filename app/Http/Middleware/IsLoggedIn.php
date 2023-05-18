<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class IsLoggedIn extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards) {
        if(FacadesAuth::user()) {
            return $next($request);
        }
        
        return redirect('/login')->with('login-required', 'You must login to continue');
    }
}
