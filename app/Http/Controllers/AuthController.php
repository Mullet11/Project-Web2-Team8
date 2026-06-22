<?php

namespace App\Http\Controllers;

use App\Application\Auth\LoginUser;
use App\Http\Requests\LoginRequest;
use App\Models\User;
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
        return view('auth.login', ['is_signup' => true]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'whatsapp' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $validated['email'];

        // Automatically determine role based on email domain
        if (str_ends_with($email, '@mhs.ulm.ac.id')) {
            $role = 'mahasiswa';
        } elseif (str_ends_with($email, '@ulm.ac.id')) {
            $role = 'dosen';
        } else {
            return back()->withErrors([
                'email' => 'Email harus menggunakan domain resmi @mhs.ulm.ac.id (untuk mahasiswa) atau @ulm.ac.id (untuk dosen).',
            ])->withInput();
        }

        $user = User::create([
            'name' => $validated['name'],
            'identity_number' => $validated['identity_number'],
            'email' => $email,
            'whatsapp' => $validated['whatsapp'],
            'faculty' => $validated['faculty'],
            'study_program' => $validated['study_program'],
            'role' => $role,
            'password' => $validated['password'],
        ]);

        return redirect('/login?registered=1');
    }
}
