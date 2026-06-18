<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;

class AdminController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['room'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.dashboard', compact('reservations'));
    }

    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'disetujui']);

        return back()->with('success', 'Peminjaman disetujui!');
    }

    public function reject(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'ditolak']);

        return back()->with('success', 'Peminjaman ditolak!');
    }
}
