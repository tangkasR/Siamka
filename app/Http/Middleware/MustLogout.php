<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MustLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            Auth::guard('admin')->check() != null
        ) {
            return redirect()->intended('dashboard');
        }
        if (
            Auth::guard('siswa')->check() != null
        ) {
            return redirect()->intended('dashboard');
        }
        if (
            Auth::guard('guru')->check() != null
        ) {
            return redirect()->intended('dashboard');
        }
        return $next($request);
    }
}
