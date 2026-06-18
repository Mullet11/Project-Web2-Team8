<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Reservation;
use App\ViewModels\BookingViewModel;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function showRoom($id)
    {
        $room = Room::findOrFail($id);
        
        $roomData = [
            'name' => $room->name,
            'building' => $room->building,
            'capacity' => $room->capacity,
            'type' => $room->facilities ?? 'Ruang Kelas',
            'status' => $room->status === 'available' ? 'tersedia' : 'terpakai'
        ];

        if ($room->status === 'occupied') {
            $schedules = Reservation::where('room_id', $room->id)
                            ->where('tanggal', date('Y-m-d'))
                            ->whereIn('status', ['disetujui'])
                            ->orderBy('waktu_mulai')
                            ->get();
                            
            $formattedSchedules = BookingViewModel::formatSchedules($schedules);
            
            return view('viewClass.viewClassUsed', [
                'id' => $room->id,
                'room' => $roomData,
                'schedules' => $formattedSchedules
            ]);
        }

        $todayBookings = Reservation::where('room_id', $room->id)
                            ->where('tanggal', date('Y-m-d'))
                            ->whereIn('status', ['disetujui', 'menunggu'])
                            ->get();
                            
        $slots = BookingViewModel::generateTimeSlots($todayBookings);

        return view('booking.select-time', [
            'id' => $room->id,
            'room' => $roomData,
            'slots' => $slots
        ]);
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'prodi_fakultas' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'perihal' => 'required|string|in:Perkuliahan,Kegiatan Kampus',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        $exists = Reservation::where('room_id', $id)
            ->where('tanggal', $validated['tanggal'])
            ->where('waktu_mulai', $validated['waktu_mulai'])
            ->whereIn('status', ['disetujui', 'menunggu'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['waktu_mulai' => 'Maaf, jadwal ini baru saja dibooking pengguna lain! Silakan pilih jam lain.'])->withInput();
        }

        $no_booking = 'SBC-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        Reservation::create([
            'no_booking' => $no_booking,
            'user_id' => Auth::id(),
            'room_id' => $id,
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'prodi_fakultas' => $validated['prodi_fakultas'],
            'whatsapp' => $validated['whatsapp'],
            'perihal' => $validated['perihal'],
            'dosen' => $request->dosen,
            'matakuliah' => $request->matakuliah,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $validated['tanggal'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'status' => 'menunggu'
        ]);

        return redirect('/history')->with('success', 'Booking berhasil dibuat!');
    }
}
