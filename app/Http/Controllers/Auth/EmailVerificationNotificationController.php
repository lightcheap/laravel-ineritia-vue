<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($this->user($request)->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::home());
        }

        $this->user($request)->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
