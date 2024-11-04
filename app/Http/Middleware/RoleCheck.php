<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    

    public function handle(Request $request, Closure $next, ...$roles){
        foreach ($roles as $role) {
            if (Auth::check() && Auth::user()->role == $role) {
                return $next($request);
            }
        }

        // Kalo rolenya gada, maka paksa keluar dan kasih status You are not authorized to access this page
        Auth::logout();
        return redirect()->route('login')->with('status','You are not authorized to access this page.');
    }

    // public function handle(Request $request, Closure $next, $role): Response
    // {
    //     if($request->user()->role !== $role){
    //         return redirect('dashboard');
    //     }
    //     return $next($request);
    // }
}
