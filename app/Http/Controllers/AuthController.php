<?php

namespace App\Http\Controllers;

use App\Application\Auth\LoginUser;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses request login dari form
     */
    public function login(LoginRequest $request, LoginUser $loginUser)
    {
        $credentials = $request->only('identity_number', 'password');

        if ($loginUser->execute($credentials)) {
            // Berhasil login, arahkan ke dashboard
            return redirect()->route('dashboard');
        }

        // Gagal login, kembali ke halaman login membawa error
        return back()->withErrors([
            'identity_number' => 'NIM/NIDN atau password salah.',
        ])->onlyInput('identity_number');
    }

    /**
     * Memproses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
