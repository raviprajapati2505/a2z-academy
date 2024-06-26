<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin') {
                    return redirect('/admin/manage_admin');
                } else if (Auth::user()->role == 'Credentials') {
                    return redirect('/admin/manage_course');
                } else if (Auth::user()->role == 'Teacher') {
                    return redirect('/teacher/home');
                } else {
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
