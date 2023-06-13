<?php

namespace App\Http\Middleware\Common;

use Closure;
use Illuminate\Http\Request;

class Template
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $template = null)
    {
        session()->put('template', $template ?? config('dynamic.application.template'));

        return $next($request);
    }
}
