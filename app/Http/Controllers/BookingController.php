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
            'campus' => $room->campus,
            'capacity' => $room->capacity,
            'facilities' => $room->facilities,
            'status' => $room->status === 'available' ? 'tersedia' : 'terpakai'
        ];

        $date = request()->query('date', date('Y-m-d'));
        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            $date = date('Y-m-d');
        }

        $dayOfWeek = date('l', strtotime($date));
        $dayMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];
        $indonesianDay = $dayMap[$dayOfWeek] ?? 'Senin';

        $todayBookings = Reservation::where('room_id', $room->id)
                            ->where('tanggal', $date)
                            ->whereIn('status', ['disetujui', 'menunggu'])
                            ->get();

        $routineSchedules = \App\Models\Schedule::with('room')
                            ->where('room_id', $room->id)
                            ->where('day', $indonesianDay)
                            ->get();
                            
        $slots = BookingViewModel::generateTimeSlots($todayBookings, $routineSchedules);

        $formattedDate = \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y');

        return view('booking.select-time', [
            'id' => $room->id,
            'room' => $roomData,
            'slots' => $slots,
            'date' => $date,
            'formattedDate' => $formattedDate
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
            ->whereIn('status', ['disetujui', 'menunggu'])
            ->where(function ($query) use ($validated) {
                $query->where('waktu_mulai', '<', $validated['waktu_selesai'])
                      ->where('waktu_selesai', '>', $validated['waktu_mulai']);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['waktu_mulai' => 'Maaf, jadwal ini baru saja dibooking pengguna lain! Silakan pilih jam lain.'])->withInput();
        }

        // Get day of week in Indonesian
        $dayOfWeek = date('l', strtotime($validated['tanggal']));
        $dayMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];
        $indonesianDay = $dayMap[$dayOfWeek] ?? 'Senin';

        // Check if overlaps with routine academic schedules / lockouts
        $routineExists = \App\Models\Schedule::where('room_id', $id)
            ->where('day', $indonesianDay)
            ->where(function ($query) use ($validated) {
                $query->where('start_time', '<', $validated['waktu_selesai'])
                      ->where('end_time', '>', $validated['waktu_mulai']);
            })
            ->exists();

        if ($routineExists) {
            return back()->withErrors(['waktu_mulai' => 'Maaf, waktu pemesanan bentrok dengan jadwal kuliah tetap atau penguncian akademik!'])->withInput();
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
