<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TailorOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('users')->guest() || Auth::guard('users')->user()->is_tailor == 0) {
            if ($request->ajax() || $request->wantsJson()) {
                return request('Unauthorized.', 401);
            } else {
                addError('Unauthorized');
                return redirect()->guest(route('home'));
            }
        }

        return $next($request);
    }
}
