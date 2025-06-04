<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffdesaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role != UserRole::Staffdesa) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
