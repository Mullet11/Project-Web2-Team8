<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\ViewModels\HistoryViewModel;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('room')
                            ->where('user_id', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();

        $historyCards = HistoryViewModel::formatIndex($reservations);

        return view('history.index', compact('historyCards'));
    }

    public function show($id)
    {
        $query = Reservation::with('room');
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        $reservation = $query->findOrFail($id);

        $booking = HistoryViewModel::formatDetail($reservation);

        return view('viewDetailHistory.viewDetailHistoryClass', compact('booking'));
    }

    public function edit($id)
    {
        $reservation = Reservation::with('room')
                            ->where('user_id', Auth::id())
                            ->where('status', 'menunggu')
                            ->findOrFail($id);

        $booking = HistoryViewModel::formatDetail($reservation);

        return view('viewDetailHistory.editDetailHistory', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::where('user_id', Auth::id())
                            ->where('status', 'menunggu')
                            ->findOrFail($id);

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

        // 1. Check reservation overlap (excluding self)
        $exists = Reservation::where('room_id', $reservation->room_id)
            ->where('tanggal', $validated['tanggal'])
            ->where('id', '!=', $id)
            ->whereIn('status', ['disetujui', 'menunggu'])
            ->where(function ($query) use ($validated) {
                $query->where('waktu_mulai', '<', $validated['waktu_selesai'])
                      ->where('waktu_selesai', '>', $validated['waktu_mulai']);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['waktu_mulai' => 'Maaf, waktu tersebut sudah dibooking oleh pengguna lain!'])->withInput();
        }

        // 2. Check routine schedule overlap
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

        $routineExists = \App\Models\Schedule::where('room_id', $reservation->room_id)
            ->where('day', $indonesianDay)
            ->where(function ($query) use ($validated) {
                $query->where('start_time', '<', $validated['waktu_selesai'])
                      ->where('end_time', '>', $validated['waktu_mulai']);
            })
            ->exists();

        if ($routineExists) {
            return back()->withErrors(['waktu_mulai' => 'Maaf, waktu pemesanan bentrok dengan jadwal kuliah tetap atau penguncian akademik!'])->withInput();
        }

        $reservation->update([
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
            // Jika ada pembatalan dari mahasiswa (form punya opsi batal):
            'status' => $request->has('cancel_booking') ? 'dibatalkan' : 'menunggu',
            'alasan_batal' => $request->alasan_batal ?? $reservation->alasan_batal
        ]);

        return redirect('/history/detail/' . $reservation->id . '?edited=1')->with('success', 'Perubahan berhasil disimpan!');
    }
}
