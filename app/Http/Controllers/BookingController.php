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

    public function viewClassUsed($id)
    {
        $room = Room::findOrFail($id);
        
        $today = date('Y-m-d');
        $dayOfWeek = date('l', strtotime($today));
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

        // Get approved reservations for today
        $todayBookings = Reservation::where('room_id', $room->id)
                            ->where('tanggal', $today)
                            ->where('status', 'disetujui')
                            ->get();

        // Get routine academic schedules for today
        $routineSchedules = \App\Models\Schedule::with('room')
                            ->where('room_id', $room->id)
                            ->where('day', $indonesianDay)
                            ->get();

        // Merge into standard objects
        $events = collect();

        foreach ($todayBookings as $res) {
            $events->push((object)[
                'waktu_mulai' => $res->waktu_mulai,
                'waktu_selesai' => $res->waktu_selesai,
                'perihal' => $res->perihal,
                'matakuliah' => $res->matakuliah,
                'nama_kegiatan' => $res->nama_kegiatan,
                'dosen' => $res->dosen,
                'nama' => $res->nama,
                'prodi_fakultas' => $res->prodi_fakultas,
                'whatsapp' => $res->whatsapp,
            ]);
        }

        foreach ($routineSchedules as $sched) {
            $events->push((object)[
                'waktu_mulai' => $sched->start_time,
                'waktu_selesai' => $sched->end_time,
                'perihal' => $sched->type === 'fixed_class' ? 'Perkuliahan' : 'Kegiatan Kampus',
                'matakuliah' => $sched->type === 'fixed_class' ? $sched->title : null,
                'nama_kegiatan' => $sched->type === 'general' ? $sched->title : null,
                'dosen' => $sched->lecturer_name,
                'nama' => $sched->lecturer_name ?? 'BAAK Akademik',
                'prodi_fakultas' => $sched->prodi ? $sched->prodi . ' / ' . ($sched->room->faculty ?? '') : 'Fakultas ' . ($sched->room->faculty ?? ''),
                'whatsapp' => '',
            ]);
        }

        // Sort events chronologically by waktu_mulai
        $sortedEvents = $events->sortBy('waktu_mulai');

        // Format schedules using BookingViewModel helper
        $formattedSchedules = BookingViewModel::formatSchedules($sortedEvents);

        // Determine room type label
        $data_type = 'kelas';
        if (stripos($room->name, 'Lab') !== false) {
            $data_type = 'lab';
        } elseif (stripos($room->name, 'Aula') !== false) {
            $data_type = 'aula';
        } elseif (stripos($room->name, 'Teater') !== false || stripos($room->name, 'Theater') !== false) {
            $data_type = 'theater';
        }

        $type_label = match ($data_type) {
            'lab' => 'Laboratorium',
            'aula' => 'Aula',
            'theater' => 'Theater',
            default => 'Ruang kelas',
        };

        $roomData = [
            'id' => $room->id,
            'name' => $room->name,
            'campus' => $room->campus,
            'capacity' => $room->capacity,
            'type' => $type_label,
        ];

        return view('viewClass.viewClassUsed', [
            'room' => $roomData,
            'schedules' => $formattedSchedules
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
