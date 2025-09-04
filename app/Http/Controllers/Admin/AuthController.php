<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || $user->role !== 'admin') {
        return back()->withErrors(['email' => 'No admin account found with this email.']);
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Invalid password.']);
    }

    Auth::login($user);

    // Optional: regenerate session
    $request->session()->regenerate();

    return redirect()->route('admin.dashboard');
}

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    public function showForgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    public function sendOtp(Request $request)
    {

        $request->validate([
            'email' => 'required|email',

        ]);

        #check if user exist
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'email not found.');
        }

        #generate otp

        $otp = rand(100000, 999999);

        #save otp in DB

        AdminOtp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'is_active' => false,

        ]);

        // Send OTP via email
        Mail::raw("Your Otp is: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Your OTP Code');
        });

        // Store email in session for later verification
        session(['email' => $request->email]);
        return redirect()->route('otp.verify.page')->with('success', 'OTP sent successfully.');
    }
    public function otpVerify()
    {
        return view('auth.verify-otp');
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        // Get email from session
        $email = session('email');

        if (!$email) {
            return redirect()->route('forgetpassword')->with('error', 'Session expired. Please try again.');
        }

        // Get the user
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('forgetpassword')->with('error', 'User not found.');
        }

        // Find latest OTP for that user
        $otpEntry = AdminOtp::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->latest()
            ->first();

        if (!$otpEntry) {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        $otpEntry->is_active = true;
        $otpEntry->save();

        // Optionally: Redirect to reset password form
        return redirect()->route('reset.password')->with('success', 'OTP verified successfully. You may now reset your password.');
    }

    public function resetpassword()
    {
        return view('auth.reset-password');
    }


    function updatepassword(Request $request)
    {

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = session('email');

        if (!$email) {

            return redirect()->route('forgetpassword')->with('error', 'error not found');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forgetpassword')->with('error', 'user not found');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('email');

        return redirect()->route('auth.login')->with('success', 'Password reset successfully. Please log in.');
    }
}
