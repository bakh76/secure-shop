<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate user credentials
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // 1. Check if user has 2FA enabled
        if ($user->google2fa_enabled) {
            // Logout temporarily
            Auth::logout();

            // Store user ID in session for 2FA verification
            $request->session()->put('2fa:user:id', $user->id);

            // Redirect to 2FA verify page
            return redirect()->route('2fa.verify');
        }

        // 2. No 2FA → Check Role and Redirect
        // 🔥 REDIRECT BASED ON ROLE
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}