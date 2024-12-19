<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
    
class EnsureUserIsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user adalah customer
        if (Auth::check() && Auth::user()->role === 'customer') {
            return $next($request);
        }

        // Redirect jika tidak memiliki akses
        return redirect()->route('login')->withErrors([
            'error' => 'Unauthorized access for non-customer.',
        ]);
    }
    
}
