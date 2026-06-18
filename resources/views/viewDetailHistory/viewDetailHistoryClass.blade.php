@extends('layouts.app')

@section('title', 'Detail Booking - Smart Class Booking')

@php
    $status = $booking['status'];
    $theme = [
        'color' => 'blue',
        'badge_bg' => 'bg-blue-50',
        'badge_border' => 'border-blue-200',
        'badge_text' => 'text-blue-600',
        'btn_primary' => 'bg-blue-600 hover:bg-blue-700 shadow-blue-600/15 focus:ring-blue-600/20',
        'card_bg' => 'bg-blue-50/35 border-blue-100',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        'title' => 'Booking Disetujui',
        'message' => 'Peminjaman ruangan Anda telah disetujui. Silakan tunjukkan E-Booking ini kepada laboran/dosen yang bertugas saat jam peminjaman dimulai.'
    ];

    if ($status === 'selesai') {
        $theme = [
            'color' => 'teal',
            'badge_bg' => 'bg-emerald-50',
            'badge_border' => 'border-emerald-200',
            'badge_text' => 'text-emerald-600',
            'btn_primary' => 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-600/15 focus:ring-emerald-600/20',
            'card_bg' => 'bg-emerald-50/35 border-emerald-100',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>',
            'title' => 'Peminjaman Selesai',
            'message' => 'Peminjaman ruangan telah diselesaikan secara tertib. Terima kasih telah menjaga kebersihan dan ketertiban fasilitas selama penggunaan.'
        ];
    } elseif ($status === 'dibatalkan') {
        $theme = [
            'color' => 'rose',
            'badge_bg' => 'bg-rose-50',
            'badge_border' => 'border-rose-200',
            'badge_text' => 'text-rose-600',
            'btn_primary' => 'bg-rose-600 hover:bg-rose-700 shadow-rose-600/15 focus:ring-rose-600/20',
            'card_bg' => 'bg-rose-50/35 border-rose-100',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            'title' => 'Booking Dibatalkan',
            'message' => 'Pengajuan peminjaman ruangan ini dibatalkan oleh pihak pengelola. Silakan lihat alasan pembatalan di bawah.'
        ];
    } elseif ($status === 'menunggu') {
        $theme = [
            'color' => 'slate',
            'badge_bg' => 'bg-slate-100',
            'badge_border' => 'border-slate-200',
            'badge_text' => 'text-slate-600',
            'btn_primary' => 'bg-slate-600 hover:bg-slate-700 shadow-slate-600/15 focus:ring-slate-600/20',
            'card_bg' => 'bg-slate-50/50 border-slate-100',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            'title' => 'Booking Menunggu Persetujuan',
            'message' => 'Pengajuan peminjaman ruangan Anda sedang dalam antrean review oleh admin BAAK. Anda dapat mengedit data peminjaman selama status masih menunggu persetujuan.'
        ];
    }
@endphp

@section('content')
<!-- Header Banner / Back Button (Matches brand style) -->
<div class="relative w-full h-32 bg-gradient-to-r from-blue-500/10 via-indigo-500/5 to-blue-600/10 -mt-20 lg:-mt-8 -mx-4 sm:-mx-6 lg:-mx-8 w-[calc(100%+2rem)] sm:w-[calc(100%+3rem)] lg:w-[calc(100%+4rem)] rounded-none border-b border-blue-100/30 mb-8 flex items-center justify-center overflow-hidden select-none">
    <div class="w-full max-w-[1440px] px-4 sm:px-6 lg:px-10 flex items-center justify-between">
        <div class="flex items-center gap-5">
            <!-- Back button to history -->
            <a href="/history" class="w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-105 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="space-y-0.5">
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Detail Booking</h1>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Nomor Booking: {{ $booking['no_booking'] }}</p>
            </div>
        </div>
        <!-- Dynamic Status Badge -->
        <span class="px-4 py-2 {{ $theme['badge_bg'] }} border {{ $theme['badge_border'] }} {{ $theme['badge_text'] }} text-xs font-black rounded-xl select-none shrink-0 tracking-wider uppercase">
            {{ $booking['status'] }}
        </span>
    </div>
</div>

@if(request()->has('edited'))
    <!-- Success Banner (Green theme) -->
    <div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 mb-6 select-none animate-slide-down">
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="space-y-0.5">
                    <p class="text-sm font-black">Perubahan Berhasil Disimpan!</p>
                    <p class="text-xs font-semibold text-emerald-600">Informasi pengajuan peminjaman ruangan Anda telah diperbarui.</p>
                </div>
            </div>
            <!-- Close button -->
            <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 cursor-pointer transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif

<!-- Main Content Grid -->
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mb-10">

    <!-- LEFT PANEL: Rincian Data Booking (7 Columns) -->
    <div class="lg:col-span-7 bg-white rounded-[28px] border border-slate-100 p-8 shadow-sm flex flex-col justify-between">
        <div class="space-y-6">
            <!-- Section Title -->
            <div class="border-b border-slate-100 pb-3 select-none">
                <h3 class="text-lg font-black text-slate-950 tracking-tight">Informasi Peminjam</h3>
            </div>

            <!-- Fields List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-8 text-sm">
                <!-- Nama Lengkap -->
                <div class="space-y-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Nama Lengkap</span>
                    <p class="font-extrabold text-slate-800">{{ $booking['nama'] }}</p>
                </div>
                <!-- NIM -->
                <div class="space-y-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">NIM</span>
                    <p class="font-extrabold text-slate-800">{{ $booking['nim'] }}</p>
                </div>
                <!-- Prodi/Fakultas -->
                <div class="space-y-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Prodi / Fakultas</span>
                    <p class="font-extrabold text-slate-800">{{ $booking['prodi_fakultas'] }}</p>
                </div>
                <!-- No. WhatsApp -->
                <div class="space-y-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">No. WhatsApp</span>
                    <p class="font-extrabold text-slate-800">{{ $booking['whatsapp'] }}</p>
                </div>
            </div>

            <!-- Section Title: Peminjaman -->
            <div class="border-b border-slate-100 pb-3 pt-4 select-none">
                <h3 class="text-lg font-black text-slate-950 tracking-tight">Rincian Kegiatan & Waktu</h3>
            </div>

            <!-- Booking Fields List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-8 text-sm">
                <!-- Perihal Peminjaman -->
                <div class="space-y-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Perihal Peminjaman</span>
                    <span class="inline-block px-2.5 py-0.5 mt-1 bg-slate-100 text-slate-600 text-[10px] font-black rounded-md uppercase tracking-wider">
                        {{ $booking['perihal'] }}
                    </span>
                </div>

                <!-- Dynamic: Dosen/Matkul vs Nama Kegiatan -->
                @if($booking['perihal'] === 'Kegiatan Kampus')
                    <div class="space-y-1 sm:col-span-2">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Nama Kegiatan</span>
                        <p class="font-extrabold text-slate-800 leading-snug">{{ $booking['nama_kegiatan'] }}</p>
                    </div>
                @else
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Dosen Pengampu</span>
                        <p class="font-extrabold text-slate-800">{{ $booking['dosen'] }}</p>
                    </div>
                    <div class="space-y-1">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Mata Kuliah</span>
                        <p class="font-extrabold text-slate-800">{{ $booking['matakuliah'] }}</p>
                    </div>
                @endif

                <!-- Tanggal -->
                <div class="space-y-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Tanggal Peminjaman</span>
                    <p class="font-extrabold text-slate-800">{{ $booking['tanggal'] }}</p>
                </div>
                <!-- Waktu -->
                <div class="space-y-1">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider select-none">Waktu Penggunaan</span>
                    <p class="font-extrabold text-slate-800">{{ $booking['waktu'] }}</p>
                </div>
            </div>
        </div>

        <div class="pt-6 mt-6 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 font-semibold select-none">
            <span>Metode: Online E-Booking</span>
            <span>ID: {{ $booking['no_booking'] }}</span>
        </div>
    </div>

    <!-- RIGHT PANEL: Status & Info Penanggung Jawab (5 Columns) -->
    <div class="lg:col-span-5 flex flex-col gap-6">
        <!-- Room Info Card (Visual representation of room being booked) -->
        <div class="bg-white rounded-[28px] border border-slate-100 p-6 shadow-sm flex items-center gap-5">
            <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-2xl p-3 flex items-center justify-center shrink-0">
                <img src="{{ asset('images/profile/ULM PNG.png') }}" alt="ULM Logo" class="max-h-full max-w-full object-contain filter drop-shadow-sm">
            </div>
            <div class="space-y-1 overflow-hidden select-none">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Ruangan Dipesan</span>
                <h4 class="text-lg font-black text-slate-900 leading-tight truncate">{{ $booking['room_name'] }}</h4>
                <p class="text-xs text-slate-500 font-semibold truncate">{{ $booking['building'] }} &bull; {{ $booking['capacity'] }} Kursi</p>
            </div>
        </div>

        <!-- Themed Status & Instruction Box -->
        <div class="bg-white rounded-[28px] border border-slate-100 p-7 shadow-sm flex-grow flex flex-col justify-between">
            <div class="space-y-6">
                <!-- Status Header -->
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl {{ $theme['badge_bg'] }} border {{ $theme['badge_border'] }} flex items-center justify-center">
                        {!! $theme['icon'] !!}
                    </div>
                    <div>
                        <h4 class="text-base font-black text-slate-950">{{ $theme['title'] }}</h4>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status Pengajuan</span>
                    </div>
                </div>

                <!-- Info message text -->
                <p class="text-sm font-semibold text-slate-500 leading-relaxed">
                    {{ $theme['message'] }}
                </p>

                <!-- Cancellation Reason (Only shown if status is Canceled) -->
                @if($status === 'dibatalkan')
                    <div class="p-4 bg-rose-50 border border-rose-100 rounded-2xl space-y-1.5">
                        <span class="text-[10px] font-extrabold text-rose-500 uppercase tracking-wider select-none">Alasan Batal BAAK</span>
                        <p class="text-xs font-semibold text-rose-700 leading-relaxed">
                            "{{ $booking['alasan_batal'] }}"
                        </p>
                    </div>
                @endif
            </div>

            <!-- Actions block -->
            <div class="pt-6 border-t border-slate-100 space-y-3 mt-6">
                @if($status === 'disetujui')
                    <!-- Cetak slip booking -->
                    <button type="button" onclick="window.print()"
                        class="w-full py-3.5 {{ $theme['btn_primary'] }} text-white text-xs font-bold rounded-xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Cetak Bukti Booking</span>
                    </button>
                    <!-- WhatsApp contact support -->
                    <a href="https://wa.me/{{ $booking['whatsapp'] }}" target="_blank"
                        class="w-full py-3.5 bg-emerald-50 hover:bg-emerald-100 border border-emerald-100 text-emerald-600 hover:text-emerald-700 text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4.5 h-4.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.665.989 3.3 1.472 5.358 1.473 5.467 0 9.914-4.444 9.918-9.909.002-2.646-1.02-5.136-2.889-7.001C17.16 1.85 14.678.826 12.01.826c-5.468 0-9.915 4.445-9.919 9.91-.001 2.115.56 4.18 1.624 5.995l-1.064 3.887 3.996-1.048zm11.238-6.197c-.272-.136-1.61-.794-1.859-.885-.25-.091-.432-.136-.613.136-.182.273-.705.885-.863 1.067-.159.182-.318.205-.59.069-.272-.136-1.15-.424-2.19-1.353-.809-.721-1.355-1.613-1.514-1.886-.159-.273-.017-.42.119-.556.122-.122.272-.318.409-.477.136-.159.182-.272.272-.454.091-.181.045-.341-.023-.477-.068-.136-.613-1.477-.84-2.023-.222-.534-.488-.46-.613-.466-.12-.005-.272-.006-.432-.006-.159 0-.417.06-.634.295-.218.236-.832.813-.832 1.984 0 1.171.852 2.302.97 2.461.119.159 1.674 2.557 4.057 3.586.567.245 1.01.391 1.356.501.57.181 1.088.156 1.498.094.457-.069 1.61-.659 1.838-1.295.227-.636.227-1.182.159-1.295-.068-.113-.25-.205-.522-.341z" />
                        </svg>
                        <span>Hubungi Dosen / Laboran</span>
                    </a>
                @elseif($status === 'selesai')
                    <!-- Beri ulasan -->
                    
                    <!-- Kembali -->
                    <a href="/history"
                        class="w-full py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <span>Kembali ke Riwayat</span>
                    </a>
                @elseif($status === 'menunggu')
                    <!-- Edit Peminjaman -->
                    <a href="/history/edit/menunggu"
                        class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit Peminjaman</span>
                    </a>
                    <!-- Hubungi admin BAAK -->
                    <a href="https://wa.me/{{ $booking['whatsapp'] }}" target="_blank"
                        class="w-full py-3.5 bg-emerald-50 hover:bg-emerald-100 border border-emerald-100 text-emerald-600 hover:text-emerald-700 text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4.5 h-4.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.665.989 3.3 1.472 5.358 1.473 5.467 0 9.914-4.444 9.918-9.909.002-2.646-1.02-5.136-2.889-7.001C17.16 1.85 14.678.826 12.01.826c-5.468 0-9.915 4.445-9.919 9.91-.001 2.115.56 4.18 1.624 5.995l-1.064 3.887 3.996-1.048zm11.238-6.197c-.272-.136-1.61-.794-1.859-.885-.25-.091-.432-.136-.613.136-.182.273-.705.885-.863 1.067-.159.182-.318.205-.59.069-.272-.136-1.15-.424-2.19-1.353-.809-.721-1.355-1.613-1.514-1.886-.159-.273-.017-.42.119-.556.122-.122.272-.318.409-.477.136-.159.182-.272.272-.454.091-.181.045-.341-.023-.477-.068-.136-.613-1.477-.84-2.023-.222-.534-.488-.46-.613-.466-.12-.005-.272-.006-.432-.006-.159 0-.417.06-.634.295-.218.236-.832.813-.832 1.984 0 1.171.852 2.302.97 2.461.119.159 1.674 2.557 4.057 3.586.567.245 1.01.391 1.356.501.57.181 1.088.156 1.498.094.457-.069 1.61-.659 1.838-1.295.227-.636.227-1.182.159-1.295-.068-.113-.25-.205-.522-.341z" />
                        </svg>
                        <span>Hubungi Admin BAAK</span>
                    </a>
                @else
                    <!-- Pesan ruangan lain -->
                    <a href="/dashboard"
                        class="w-full py-3.5 {{ $theme['btn_primary'] }} text-white text-xs font-bold rounded-xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Pesan Ruangan Lain</span>
                    </a>
                    <!-- Hubungi admin BAAK -->
                    <a href="https://wa.me/{{ $booking['whatsapp'] }}" target="_blank"
                        class="w-full py-3.5 bg-emerald-50 hover:bg-emerald-100 border border-emerald-100 text-emerald-600 hover:text-emerald-700 text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4.5 h-4.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.665.989 3.3 1.472 5.358 1.473 5.467 0 9.914-4.444 9.918-9.909.002-2.646-1.02-5.136-2.889-7.001C17.16 1.85 14.678.826 12.01.826c-5.468 0-9.915 4.445-9.919 9.91-.001 2.115.56 4.18 1.624 5.995l-1.064 3.887 3.996-1.048zm11.238-6.197c-.272-.136-1.61-.794-1.859-.885-.25-.091-.432-.136-.613.136-.182.273-.705.885-.863 1.067-.159.182-.318.205-.59.069-.272-.136-1.15-.424-2.19-1.353-.809-.721-1.355-1.613-1.514-1.886-.159-.273-.017-.42.119-.556.122-.122.272-.318.409-.477.136-.159.182-.272.272-.454.091-.181.045-.341-.023-.477-.068-.136-.613-1.477-.84-2.023-.222-.534-.488-.46-.613-.466-.12-.005-.272-.006-.432-.006-.159 0-.417.06-.634.295-.218.236-.832.813-.832 1.984 0 1.171.852 2.302.97 2.461.119.159 1.674 2.557 4.057 3.586.567.245 1.01.391 1.356.501.57.181 1.088.156 1.498.094.457-.069 1.61-.659 1.838-1.295.227-.636.227-1.182.159-1.295-.068-.113-.25-.205-.522-.341z" />
                        </svg>
                        <span>Hubungi Admin BAAK</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
