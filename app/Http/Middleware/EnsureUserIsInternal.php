<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsInternal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->tipe_user !== 'internal_hbl') {
            abort(403, 'Akses ditolak: bukan user internal.');
        }
        return $next($request);
    }
    
}
