<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontEndMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->check() && auth()->user()->role == 'user' || auth()->user()->role == 'admin') {
            return $next($request);
        }
        return redirect('/user/login');
        // return redirect()->route('front.user.login');
    }
}
