<?php

namespace App\Http\Controllers;

use App\Application\Auth\LoginUser;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
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

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@mhs\.ulm\.ac\.id$/'],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.regex' => 'Email harus menggunakan domain @mhs.ulm.ac.id untuk mendaftar sebagai mahasiswa.'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'identity_number' => $validated['identity_number'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'mahasiswa',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
