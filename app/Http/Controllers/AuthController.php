<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function create()
    {
        if (Auth::user()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('backend.auth.login');
    }


    public function store(Request $request)
    {
        $credentials = $request->validate([
            'phone'    => 'required|string',
            'password' => 'required|string',
        ]);

        $remember = $request->filled('remember');

        if (auth()->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if ($remember) {
                Cookie::queue('remember_phone', $request->phone, 525600);
                Cookie::queue('remember_password', $request->password, 525600);
            } else {
                Cookie::queue(Cookie::forget('remember_phone'));
                Cookie::queue(Cookie::forget('remember_password'));
            }

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Logged in successfully.');
        }

        return back()
            ->withErrors(['phone' => 'Invalid phone number or password.'])
            ->withInput($request->only('phone'));
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}