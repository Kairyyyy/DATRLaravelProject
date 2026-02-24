<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Mail\AdminVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class VerificationController extends Controller
{
    /**
     * Show the verification page with code input
     */
    public function notice(): View
    {
        return view('admin.auth.verify-email');
    }

    /**
     * Verify the entered code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->withErrors(['error' => 'Session expired. Please login again.']);
        }

        if ($admin->email_verified_at) {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($admin->verifyCode($request->verification_code)) {
            // Redirect to dashboard with success message
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Email successfully verified! Welcome to your dashboard.');
        }

        return back()->withErrors([
            'verification_code' => 'The verification code is invalid or has expired.',
        ]);
    }

    /**
     * Resend the verification code
     */
    public function resend(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->withErrors(['error' => 'Session expired. Please login again.']);
        }

        if ($admin->email_verified_at) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Generate and send new code
        $verificationCode = $admin->generateVerificationCode();
        
        Mail::to($admin->email)->send(new AdminVerificationCode($admin, $verificationCode));

        return back()->with('status', 'A new verification code has been sent to your email.');
    }
}