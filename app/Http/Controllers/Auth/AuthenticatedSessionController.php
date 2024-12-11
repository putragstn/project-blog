<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // // kalo bukan user maka boleh masuk ke admin dashboard
        // if(Auth::user() && Auth::user()->role != 'user'){
        //     return redirect()->route('admin.dashboard');
            
        // // selain itu gaboleh masuk
        // } else { 
        //     Auth::guard('web')->logout();
        //     return redirect()->route('login')->with('status', 'You are not authorized to access this page.');
        // }

        // Ambil data pengguna yang sedang login
        $user = $request->user();

        // Pengecekan status pengguna setelah login
        if ($user->status === 'block') {
            // Logout pengguna dan beri pesan jika statusnya 'block'
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('status', 'Your account is blocked.');
        }

        if ($user->status === 'not_verified') {
            // Logout pengguna dan beri pesan jika statusnya 'not_verified'
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('status', 'Your account is not verified. Please check your email.');
        }


        $url = "";
        if ($user->role === "superadmin") {
            $url = "/superadmin/dashboard";
        } elseif ($user->role === "admin") {
            $url = "/admin/dashboard";
        } elseif ($user->role === "user") {
            $url = "/user/dashboard";
        } else {
            $url = "/login"; 
        }

        return redirect()->intended($url);

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
