<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class VerificationMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (!auth()->user()->verified) {
                $verificationToken=auth()->user()->verification_token;
                $link=trans('global.verifyYourEmail').'&nbsp;<a href="'.route('userVerification.resend', $verificationToken).'">Resend Verification Email</a>';
                auth()->logout();

                return redirect()->route('login')->with('message',$link );
            }
        }

        return $next($request);
    }
}
