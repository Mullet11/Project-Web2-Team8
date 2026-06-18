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
        $reservation = Reservation::with('room')
                            ->where('user_id', Auth::id())
                            ->findOrFail($id);

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
