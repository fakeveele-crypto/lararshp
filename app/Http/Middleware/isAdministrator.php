<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user_role') || session('user_role') != 1) {
            return redirect('/login')->withErrors(['access' => 'Akses ditolak. Anda tidak memiliki izin Administrator.']);
        }
        return $next($request);
    }
}
