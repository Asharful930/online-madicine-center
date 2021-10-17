<?php
	namespace App\Http\Middleware;
	
	use Closure;

	class CheckSeller
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
				return $next($request);
			} else if(auth()->user()){
				return redirect()->route('home');
			}else if(auth()->guard('manager')->user()){
				return redirect()->route('manager.index');
			}
			return redirect('/seller/login');
		}
	}
	 