<?php

namespace App\Http\Middleware;

use Closure;

class CheckShopManager
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
        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.index');
        }else if (auth()->guard('sellers')->user()){
            return redirect()->route('seller.index');
        } else if(auth()->user()){
            return redirect()->route('home');
        }else if(auth()->guard('manager')->user()){
            return $next($request);
        }
        return redirect('/manager/login');
    }
}
