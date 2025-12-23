<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PragmaRX\Google2FALaravel\Google2FA;

class TwoFactorAuthController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = app('pragmarx.google2fa');
    }

    public function show2faForm()
    {
        $user = Auth::user();

        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $this->google2fa->generateSecretKey();
            $user->save();
        }

        $QR_Image = $this->google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        return view('2fa.enable', [
            'QR_Image' => $QR_Image,
            'secret' => $user->google2fa_secret
        ]);
    }

    public function enable2fa(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|digits:6',
        ]);

        $user = Auth::user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if ($valid) {
            $user->google2fa_enabled = true;
            $user->save();

            // Redirect back to profile with success message
            return redirect()->route('profile.edit')->with('status', 'two-factor-authentication-enabled');
        }

        return redirect()->back()->with('error', 'Invalid OTP, please try again.');
    }

    // 🔥 NEW: Disable 2FA
    public function disable2fa(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password', // Require password to disable for security
        ]);

        $user = Auth::user();
        $user->google2fa_enabled = false;
        $user->google2fa_secret = null; // Optional: Clear secret if you want them to re-scan next time
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'two-factor-authentication-disabled');
    }

    public function verifyForm(Request $request)
    {
        if (!$request->session()->has('2fa:user:id')) {
            return redirect()->route('login')->with('error', 'No 2FA session found.');
        }

        return view('2fa.verify');
    }

    // In TwoFactorAuthController.php

public function verify2fa(Request $request)
{
    $request->validate([
        'one_time_password' => 'required|digits:6',
    ]);

    $userId = $request->session()->get('2fa:user:id');
    $user = User::find($userId);

    if (!$user) {
        return redirect()->route('login');
    }

    $google2fa = app('pragmarx.google2fa');

    $valid = $google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

    if ($valid) {
        Auth::login($user);
        $request->session()->forget('2fa:user:id');
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    // 💡 CHANGE THIS LINE: 
    // From: return redirect()->back()->withErrors(['one_time_password' => 'Invalid OTP. Please try again.']);
    // To: 
    return redirect()->back()->with('error', 'The two-factor authentication code is invalid. Please try again.');
}
}