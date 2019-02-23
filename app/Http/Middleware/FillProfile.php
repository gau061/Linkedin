<?php

namespace App\Http\Middleware;

use Closure;

class FillProfile
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
        if(auth()->guard('frontuser')->user()->profile_status == 'Pending'){
            return redirect()->route('profile.fill','location');
        }
        return $next($request);
    }
}
