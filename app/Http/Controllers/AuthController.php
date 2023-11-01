<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $req)
    {
        $val = $req->validate([
            'email' => ['required', Rule::exists('users', 'email')],
            'password' => ['required'],
        ]);
        if (Auth::attempt($val)) {
            $req->session()->regenerate();
            return redirect()->route('dashboard.index');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
