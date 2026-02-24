<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user('admin')) {
            return redirect()->route('admin.login');
        }

        if ($request->user('admin')->email_verified_at) {
            return $next($request);
        }

        return redirect()->route('admin.verification.notice')
            ->with('message', 'Please verify your email first.');
    }
}