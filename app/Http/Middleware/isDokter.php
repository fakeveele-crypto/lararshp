<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isDokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user_role') || session('user_role') != 2) {
        return redirect('/login')->withErrors(['access' => 'Akses ditolak. Anda tidak memiliki izin Dokter.']);
        }
        return $next($request);
    }
}
