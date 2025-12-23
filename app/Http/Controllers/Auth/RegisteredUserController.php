<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail; // Import Mail Facade
use App\Mail\WelcomeUser; // Import the Mailable

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required', 
                'confirmed', 
                Rules\Password::min(8) // Minimum 8 characters
                    ->mixedCase()      // Requires Uppercase & Lowercase
                    ->numbers()        // Requires at least one number
                    ->symbols()        // Requires at least one symbol
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // 🔥 Log success message
        Log::info('Registration successful for user: ' . $user->email);

        // 🔥 Send Welcome Email
        try {
            Mail::to($user->email)->send(new WelcomeUser($user));
            Log::info('Welcome email queued for user: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
