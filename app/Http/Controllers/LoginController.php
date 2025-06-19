<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
        
        if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
            if (Auth::user()->is_admin) {
                return redirect('/moderation');
            }
            return redirect()->route('concerts.index');
    }
        
    return back()->withErrors([
        'error' => 'The provided credentials do not match our records.',
    ])->onlyInput('email', 'password');
    }
}
