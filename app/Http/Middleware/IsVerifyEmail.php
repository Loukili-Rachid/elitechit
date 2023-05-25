<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $client=Auth::guard('client')->user();
        if (!$client->is_email_verified) {
            Auth::guard('client')->logout();
            return redirect()->route('showLoginForm')
                    ->with('success', 'You need to confirm your account. We have sent you an activation code, please check your email.');
          }
        return $next($request);
    }
}
