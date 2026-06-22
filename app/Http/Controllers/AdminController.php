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

    public function schedules()
    {
        $schedules = \App\Models\Schedule::with('room')->get();
        $rooms = Room::orderBy('name', 'asc')->get();
        return view('admin.schedules', compact('schedules', 'rooms'));
    }

    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'title' => 'required|string|max:255',
            'lecturer_name' => 'nullable|string|max:255',
            'prodi' => 'nullable|string|max:255',
            'day' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required|string|in:fixed_class,general',
        ]);

        // Overlap validation check
        $exists = \App\Models\Schedule::where('room_id', $validated['room_id'])
            ->where('day', $validated['day'])
            ->where(function ($query) use ($validated) {
                $query->where('start_time', '<', $validated['end_time'])
                      ->where('end_time', '>', $validated['start_time']);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['start_time' => 'Jadwal bentrok dengan jadwal rutin lainnya di ruangan tersebut!'])->withInput();
        }

        \App\Models\Schedule::create($validated);

        return back()->with('success', 'Jadwal/Penguncian berhasil ditambahkan!');
    }

    public function updateSchedule(Request $request, $id)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'title' => 'required|string|max:255',
            'lecturer_name' => 'nullable|string|max:255',
            'prodi' => 'nullable|string|max:255',
            'day' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required|string|in:fixed_class,general',
        ]);

        // Overlap validation check (excluding this schedule)
        $exists = \App\Models\Schedule::where('room_id', $validated['room_id'])
            ->where('day', $validated['day'])
            ->where('id', '!=', $id)
            ->where(function ($query) use ($validated) {
                $query->where('start_time', '<', $validated['end_time'])
                      ->where('end_time', '>', $validated['start_time']);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'Jadwal bentrok dengan jadwal rutin lainnya di ruangan tersebut!'])->withInput();
        }

        $schedule = \App\Models\Schedule::findOrFail($id);

        if ($validated['type'] === 'general') {
            $validated['lecturer_name'] = null;
            $validated['prodi'] = null;
        }

        $schedule->update($validated);

        return back()->with('success', 'Jadwal/Penguncian berhasil diperbarui!');
    }

    public function deleteSchedule($id)
    {
        $schedule = \App\Models\Schedule::findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'Jadwal/Penguncian berhasil dihapus!');
    }

    public function reservations()
    {
        $reservations = Reservation::with(['room', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reservations', compact('reservations'));
    }
}
