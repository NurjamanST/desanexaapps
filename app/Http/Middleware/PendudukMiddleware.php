<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PendudukMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role != UserRole::Penduduk) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
