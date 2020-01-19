<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminMiddleware
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
        if ($request->user() && ($request->user()->role->role_name == 'super admin' || $request->user()->role->role_name == 'admin'))
        {
            return $next($request);
        }
        return redirect('/login')->with('error','error found!');
    }
}
