<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthcBasicOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $redirect = null, string ...$guards)
    {
        $authenticated = false;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->viaRemember() || Auth::guard($guard)->check()) {
                Auth::shouldUse($guard);
                $authenticated = true;
                break;
            }
        }
        if (!$authenticated) {
            return to_route($redirect, ['want_order' => request()->route('midwife.id')]);
        }

        return $next($request);
    }
}
