<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends AuthController
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        // dd(Route::has($this->route('password.request')));
        // return Inertia::render("Admin/Auth/Login", [
        //     'canResetPassword' => false,
        //     'status' => null,
        // ]);
        // Admin/Auth/Login, [admin.password.request, null]
        // dd(session('status'));
        return Inertia::render($this->resource('Auth/Login'), [
            'canResetPassword' => Route::has($this->route('password.request')),
            'status' => session('status'),
        ]);


        // return Inertia::render($this->resource('Auth/Login'), [
        //     'canResetPassword' => Route::has($this->route('password.request')),
        //     'status' => session('status'),
        // ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::home());
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        dd();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
