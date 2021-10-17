<?php

namespace App\Http\Middleware;

use Closure;

class CheckApprovedSeller
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
        if (auth()->guard('sellers')->user()->is_active == true) {
            return $next($request);
        }else{
            return redirect()->route('seller.approval');;
        }
    }
}
