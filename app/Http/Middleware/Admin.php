<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->admin == 1) {
            return $next($request);
        } else {
            return redirect('home');
        }
        // if (Auth::user()->admin == 1) {
        //     return $next($request);
        // }

        // return redirect('home')->with('error', "Only admin can access!");
    }
}
