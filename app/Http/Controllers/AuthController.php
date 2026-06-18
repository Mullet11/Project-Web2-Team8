<?php

namespace App\Http\Controllers;

use App\Application\Auth\LoginUser;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request, LoginUser $loginUser)
    {
        $credentials = $request->only('identity_number', 'password');

        if ($loginUser->execute($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'identity_number' => 'NIM/NIDN atau password salah.',
        ])->onlyInput('identity_number');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
