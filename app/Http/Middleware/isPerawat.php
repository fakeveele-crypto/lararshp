<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isPerawat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user_role') || session('user_role') != 3) {
            return redirect('/login')->withErrors(['access' => 'Akses ditolak. Anda tidak memiliki izin Perawat.']);
        }
        return $next($request);
    }
}
