<?php

namespace App\Http\Middleware\Common;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrator;
use App\Models\Visitor as ModelsVisitor;

class Visitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $tag = "main")
    {

        // /** @var Administrator */
        // $user = Auth::user();
        // $visitor = ModelsVisitor::visit(session('visitor_' . $tag), $tag);
        // session()->put('visitor_' . $tag, $visitor->id);

        return $next($request);
    }
}
