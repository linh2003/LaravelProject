<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::id() == null) {
            toastr()->success('Bạn không có quyền truy cập!');
            return redirect()->route('auth.admin')->with('error', 'Bạn không có quyền truy cập!');
        }
        return $next($request);
    }
}
