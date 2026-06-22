<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalBookings    = Reservation::count();
            $pendingBookings  = Reservation::where('status', 'menunggu')->count();
            $approvedBookings = Reservation::where('status', 'disetujui')->count();
        } else {
            $totalBookings    = Reservation::where('user_id', $user->id)->count();
            $pendingBookings  = Reservation::where('user_id', $user->id)->where('status', 'menunggu')->count();
            $approvedBookings = Reservation::where('user_id', $user->id)->where('status', 'disetujui')->count();
        }

        return view('profile.index', compact('user', 'totalBookings', 'pendingBookings', 'approvedBookings'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'          => 'required|string|max:255',
            'faculty'       => 'nullable|string|max:255',
            'study_program' => 'nullable|string|max:255',
            'password'      => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        // Update text fields
        $user->name          = $request->name;
        $user->faculty       = $request->faculty;
        $user->study_program = $request->study_program;

        // Handle profile photo upload
        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            try {
                // Delete old photo if exists
                if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }

                // Store new photo and save path
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $user->profile_photo_path = $path;

            } catch (\Exception $e) {
                Log::error('Profile photo upload failed: ' . $e->getMessage());
                return back()->withErrors(['profile_photo' => 'Gagal mengunggah foto. Silakan coba lagi.']);
            }
        }

        // Handle password update with proper hashing
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
