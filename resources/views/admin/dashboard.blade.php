@extends('layouts.app')

@section('title', 'Admin Dashboard - Smart Class Booking')

@section('content')
<div class="px-6 py-8 mx-auto max-w-7xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-800">Admin Dashboard (Approval)</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-sm text-left text-slate-500">
            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4">Peminjam</th>
                    <th class="px-6 py-4">Ruangan</th>
                    <th class="px-6 py-4">Waktu</th>
                    <th class="px-6 py-4">Perihal</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $res)
                <tr class="bg-white border-b hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                        {{ $res->nama }}<br>
                        <span class="text-xs text-slate-400">{{ $res->nim }}</span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $res->room->name ?? 'Unknown Room' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}<br>
                        <span class="font-semibold">{{ $res->waktu_mulai }} - {{ $res->waktu_selesai }}</span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $res->perihal }}
                    </td>
                    <td class="px-6 py-4 flex justify-center gap-2">
                        <form action="/admin/approve/{{ $res->id }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 font-bold text-xs transition">Setujui</button>
                        </form>
                        <form action="/admin/reject/{{ $res->id }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600 font-bold text-xs transition">Tolak</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                        Tidak ada pengajuan yang menunggu persetujuan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
