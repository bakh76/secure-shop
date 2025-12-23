<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            // 🔥 UPDATED PASSWORD RULES HERE
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)     // Minimum 8 characters
                    ->mixedCase()    // Requires Uppercase & Lowercase
                    ->numbers()      // Requires at least one number
                    ->symbols()      // Requires at least one symbol
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
