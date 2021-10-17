<?php

namespace App\Http\Middleware;

use Closure;

class CheckApprovedAdmin
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
        if (auth('admin')->user()->is_active == true) {
            return $next($request);
        }else{
            return redirect()->route('admin.approval');;
        }
        
    }
}
