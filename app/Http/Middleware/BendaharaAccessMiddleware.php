<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BendaharaAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sedang login dan memiliki peran "bendahara" atau "admin"
        if ($request->user() && in_array($request->user()->role, ['bendahara'])) {
            return $next($request);
        }

        // Jika pengguna tidak memiliki akses, arahkan ke halaman lain atau tampilkan pesan error
        return redirect()->route('home')->with('error', 'Anda tidak memiliki akses.');

    }
}
