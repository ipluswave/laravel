<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App;

class StaffHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        App::setLocale('cn');
        if (Auth::guard('staff')->check()) {
            if (!Auth::guard('staff')->user()->hasPermission($permission)) {
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    addError('No Permission');
                    return redirect()->route("backend.index");
                }
            }
        } else {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route("staff.login"));
            }
        }

        return $next($request);
    }
}
