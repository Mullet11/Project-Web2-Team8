<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\Room;

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

    public function rooms()
    {
        $rooms = Room::orderBy('name', 'asc')->get();
        return view('admin.rooms', compact('rooms'));
    }

    public function storeRoom(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'campus' => 'required|string|in:Kampus Banjarmasin,Kampus Banjarbaru',
            'faculty' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'status' => 'required|string|in:available,occupied,inactive',
        ]);

        Room::create($validated);

        return back()->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function updateRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'campus' => 'required|string|in:Kampus Banjarmasin,Kampus Banjarbaru',
            'faculty' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'status' => 'required|string|in:available,occupied,inactive',
        ]);

        $room->update($validated);

        return back()->with('success', 'Ruangan berhasil diperbarui!');
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return back()->with('success', 'Ruangan berhasil dihapus!');
    }
}
