<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
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
        if(Auth::user()->mmc_level!=1)
        {
            return redirect('admin')->with('flash_message', 'Bạn không thể truy cập!');;
        }
        return $next($request);
    }
}
