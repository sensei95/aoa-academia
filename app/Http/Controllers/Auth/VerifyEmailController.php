<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerificationRequest as AuthEmailVerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(AuthEmailVerificationRequest $request): RedirectResponse
    {
        if ($request->getUserFromUrl()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->getUserFromUrl()->markEmailAsVerified()) {

            if($request->getUserFromUrl()->profile) {
                $request->getUserFromUrl()->profile()->update(['status' => 'verified']);
            }

            event(new Verified($request->getUserFromUrl()));
        }
        $request->session()->flash('status', "Your account has been successfully verified, a mail has been sent to with your default login credentials.");
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
