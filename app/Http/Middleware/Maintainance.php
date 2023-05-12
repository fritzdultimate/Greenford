<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;

class Maintainance extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards) {
        if(Auth::user() && Auth::user()['name'] == 'Darlington') {
            return $next($request);
        }
        
        return redirect('/namecheap/support/tree/web/maintainance')->with('login-required', 'You must login to continue');
    }
}
