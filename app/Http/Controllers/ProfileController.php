<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalBookings = \App\Models\Reservation::count();
            $pendingBookings = \App\Models\Reservation::where('status', 'menunggu')->count();
            $approvedBookings = \App\Models\Reservation::where('status', 'disetujui')->count();
        } else {
            $totalBookings = \App\Models\Reservation::where('user_id', $user->id)->count();
            $pendingBookings = \App\Models\Reservation::where('user_id', $user->id)->where('status', 'menunggu')->count();
            $approvedBookings = \App\Models\Reservation::where('user_id', $user->id)->where('status', 'disetujui')->count();
        }

        return view('profile.index', compact('user', 'totalBookings', 'pendingBookings', 'approvedBookings'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'study_program' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->faculty = $request->faculty;
        $user->study_program = $request->study_program;

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
