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
        if(Auth::user()->isAdmin()) {
            return $next($request);
        }
        // if ($request->ajax() || $request->wantsJson()) {
        //     return response('Unauthorized.', 401);
        // }
        return redirect()->route('admin.login');
    }
}
