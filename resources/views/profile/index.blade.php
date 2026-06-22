@extends('layouts.app')
@section('title', 'Profil Saya - Smart Class Booking')
@section('content')

<!-- Page Header -->
<div class="mb-8 select-none">
    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Profil Saya</h1>
    <p class="text-sm text-slate-500 mt-1">Kelola detail informasi profil akademis dan keamanan akun Anda.</p>
</div>

@if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl relative flex items-center gap-3 shadow-sm select-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm font-semibold">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-2xl relative shadow-sm select-none">
        <div class="flex items-center gap-3 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="text-sm font-bold">Terjadi Kesalahan Validasi:</span>
        </div>
        <ul class="list-disc list-inside text-xs font-semibold space-y-0.5 text-rose-600/90 pl-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- ========== CONTENT STACK ========== -->
<div class="space-y-6">
    
    <!-- 1. Profile Identity Header Card (Full Width) -->
    <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
        
        <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-6">
            <div class="flex flex-col md:flex-row items-center gap-5">
                <!-- Avatar (ULM Logo in clean frame, guaranteed circle/square ratio) -->
                <div class="relative group select-none">
                    <div id="avatar-container" class="rounded-2xl border-4 border-slate-50 bg-slate-50/50 shadow-sm overflow-hidden flex items-center justify-center shrink-0 relative" style="width: 96px; height: 96px;">
                        <!-- Profile Image -->
                        <img id="avatar-preview" src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/profile/ULM PNG.png') }}" alt="Foto Profil" class="{{ $user->profile_photo_path ? 'w-full h-full object-cover' : 'w-16 h-16 object-contain' }}">
                        
                        <!-- Hover Overlay (Visible/Active only when editing) -->
                        <div id="avatar-overlay" class="absolute inset-0 bg-slate-900/50 flex flex-col items-center justify-center gap-1 opacity-0 hover:opacity-100 cursor-pointer transition-opacity duration-200 hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-[9px] font-black text-white uppercase tracking-wider">Ubah Foto</span>
                        </div>
                    </div>
                </div>
                <!-- Identity Info -->
                <div class="text-center md:text-left">
                    <div class="flex flex-col md:flex-row items-center gap-2.5">
                        <h2 class="text-2xl font-black text-slate-800 tracking-tight leading-none">{{ $user->name }}</h2>
                        @if($user->role === 'admin')
                            <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-md tracking-wider uppercase border border-indigo-100 select-none">
                                Administrator
                            </span>
                        @elseif($user->role === 'dosen')
                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-md tracking-wider uppercase border border-emerald-100 select-none">
                                Dosen ULM
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-[10px] font-black rounded-md tracking-wider uppercase border border-blue-100 select-none">
                                Mahasiswa ULM
                            </span>
                        @endif
                    </div>
                    <div class="mt-3.5 flex flex-wrap justify-center md:justify-start items-center gap-x-4 gap-y-1.5 text-xs font-semibold text-slate-500 select-none">
                        <span class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                            {{ $user->role === 'admin' ? 'ID Admin' : ($user->role === 'dosen' ? 'NIDN' : 'NIM') }}: {{ $user->identity_number }}
                        </span>
                        <span class="hidden md:inline text-slate-300">&bull;</span>
                        <span class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $user->email }}
                        </span>
                        @if($user->faculty || $user->study_program)
                            <span class="hidden md:inline text-slate-300">&bull;</span>
                            <span class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                {{ $user->study_program ?? '-' }} &bull; {{ $user->faculty ?? '-' }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Toggle Edit Button (Unique ID, has click listener bound in JS) -->
            <button type="button" id="toggle-edit-btn" class="flex items-center gap-1.5 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-bold rounded-xl transition-all duration-200 cursor-pointer shadow-sm shadow-blue-500/5 select-none shrink-0 self-center md:self-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit Profil</span>
            </button>
        </div>
    </div>

    @if($user->role !== 'admin')
    <!-- 2. Booking Statistics Grid (3 Columns) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 select-none">
        <!-- Total Bookings -->
        <div class="bg-white rounded-[20px] border border-slate-100 p-5 shadow-sm flex items-center justify-between group hover:border-blue-100 transition-colors duration-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        Peminjaman Saya
                    </p>
                    <p class="text-sm font-extrabold text-slate-700 mt-0.5">Semua Pengajuan</p>
                </div>
            </div>
            <span class="text-3xl font-black text-blue-600 tracking-tight">{{ $totalBookings }}</span>
        </div>

        <!-- Pending Bookings -->
        <div class="bg-white rounded-[20px] border border-slate-100 p-5 shadow-sm flex items-center justify-between group hover:border-amber-100 transition-colors duration-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        Dalam Proses
                    </p>
                    <p class="text-sm font-extrabold text-slate-700 mt-0.5">Butuh Konfirmasi</p>
                </div>
            </div>
            <span class="text-3xl font-black text-amber-600 tracking-tight">{{ $pendingBookings }}</span>
        </div>

        <!-- Approved Bookings -->
        <div class="bg-white rounded-[20px] border border-slate-100 p-5 shadow-sm flex items-center justify-between group hover:border-emerald-100 transition-colors duration-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        Disetujui
                    </p>
                    <p class="text-sm font-extrabold text-slate-700 mt-0.5">Reservasi Aktif</p>
                </div>
            </div>
            <span class="text-3xl font-black text-emerald-600 tracking-tight">{{ $approvedBookings }}</span>
        </div>
    </div>
    @endif

    <!-- 3. Form Section (Side-by-Side Cards) -->
    <form id="profile-form" action="/profile" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Hidden file input for profile photo -->
        <input type="file" id="input-avatar" name="profile_photo" class="hidden" accept="image/*" disabled>
        
        @if($user->role === 'admin')
            <!-- Admin Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Detail & Security (col-span 5) -->
                <div class="lg:col-span-5 space-y-6">
                    <!-- Detail Profil Akun Card -->
                    <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 mb-6 pb-4 border-b border-slate-50 select-none">
                                <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Detail Administrator</h3>
                            </div>

                            <div class="space-y-4">
                                <!-- Nama Lengkap (Editable) -->
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                                    <input type="text" id="input-name" name="name" value="{{ $user->name }}"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                        disabled>
                                </div>

                                <!-- ID Admin (Readonly) -->
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">ID Administrator</label>
                                    <input type="text" value="{{ $user->identity_number }}"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-400 focus:outline-none cursor-not-allowed select-none opacity-60"
                                        disabled readonly>
                                </div>

                                <!-- Email (Readonly) -->
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Resmi</label>
                                    <input type="email" value="{{ $user->email }}"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-400 focus:outline-none cursor-not-allowed select-none opacity-60"
                                        disabled readonly>
                                </div>

                                <!-- Tanggal Terdaftar -->
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Terdaftar</label>
                                    <input type="text" value="{{ $user->created_at ? $user->created_at->locale('id')->translatedFormat('d F Y') : '-' }}"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-400 focus:outline-none cursor-not-allowed select-none opacity-60"
                                        disabled readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ubah Kata Sandi Card -->
                    <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 mb-6 pb-4 border-b border-slate-50 select-none">
                                <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-500 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Keamanan & Sandi</h3>
                            </div>

                            <div class="space-y-4">
                                <p class="text-xs text-slate-400 font-semibold mb-2 select-none leading-relaxed">Untuk memperbarui kata sandi akun Anda, silakan aktifkan mode edit terlebih dahulu, lalu isi kolom berikut.</p>
                                
                                <!-- Password Baru -->
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password Baru</label>
                                    <input type="password" id="input-password" name="password" placeholder="Biarkan kosong jika tidak diubah"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                        disabled>
                                </div>
                                
                                <!-- Konfirmasi Password -->
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konfirmasi Password Baru</label>
                                    <input type="password" id="input-password-confirmation" name="password_confirmation" placeholder="Biarkan kosong jika tidak diubah"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Control Board (col-span 7) -->
                <div class="lg:col-span-7 flex flex-col">
                    <!-- Pusat Kendali Administrator Card -->
                    <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-sm flex flex-col justify-between flex-grow">
                        <div class="flex flex-col h-full justify-between flex-grow">
                            <div class="flex items-center gap-2.5 mb-6 pb-4 border-b border-slate-50 select-none">
                                <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Pusat Kendali Administrator</h3>
                            </div>
 
                            <!-- Quick Link Action Grid (Balanced 2x2 Grid) -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-grow">
                                <!-- Action 1: Persetujuan Peminjaman -->
                                <a href="/admin/dashboard" class="group p-6 bg-slate-50 hover:bg-blue-50/50 border border-slate-100 hover:border-blue-100 rounded-[20px] transition-all duration-300 flex flex-col items-center text-center justify-center min-h-[180px] flex-grow">
                                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="text-sm font-extrabold text-slate-800 group-hover:text-blue-700 transition-colors">Persetujuan Booking</h4>
                                        <p class="text-[11px] text-slate-400 font-semibold mt-1 leading-relaxed">Tinjau, setujui, atau tolak pengajuan peminjaman kelas masuk.</p>
                                    </div>
                                </a>
 
                                <!-- Action 2: Kelola Ruangan -->
                                <a href="/admin/rooms" class="group p-6 bg-slate-50 hover:bg-emerald-50/50 border border-slate-100 hover:border-emerald-100 rounded-[20px] transition-all duration-300 flex flex-col items-center text-center justify-center min-h-[180px] flex-grow">
                                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="text-sm font-extrabold text-slate-800 group-hover:text-emerald-700 transition-colors">Manajemen Ruangan</h4>
                                        <p class="text-[11px] text-slate-400 font-semibold mt-1 leading-relaxed">Tambah, edit data kapasitas, fasilitas, & status ruangan.</p>
                                    </div>
                                </a>
 
                                <!-- Action 3: Kelola Jadwal Akademik -->
                                <a href="/admin/schedules" class="group p-6 bg-slate-50 hover:bg-amber-50/50 border border-slate-100 hover:border-amber-100 rounded-[20px] transition-all duration-300 flex flex-col items-center text-center justify-center min-h-[180px] flex-grow">
                                    <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="text-sm font-extrabold text-slate-800 group-hover:text-amber-700 transition-colors">Jadwal Akademik</h4>
                                        <p class="text-[11px] text-slate-400 font-semibold mt-1 leading-relaxed">Atur dan kelola jadwal kuliah tetap BAAK per semester berjalan.</p>
                                    </div>
                                </a>
 
                                <!-- Action 4: Riwayat Booking -->
                                <a href="/history" class="group p-6 bg-slate-50 hover:bg-purple-50/50 border border-slate-100 hover:border-purple-100 rounded-[20px] transition-all duration-300 flex flex-col items-center text-center justify-center min-h-[180px] flex-grow">
                                    <div class="w-16 h-16 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="text-sm font-extrabold text-slate-800 group-hover:text-purple-700 transition-colors">Riwayat Peminjaman</h4>
                                        <p class="text-[11px] text-slate-400 font-semibold mt-1 leading-relaxed">Tinjau sejarah lengkap transaksi peminjaman ruangan yang lampau.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Non-Admin Layout (User/Dosen) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Detail Profil Akun Card -->
                <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2.5 mb-6 pb-4 border-b border-slate-50 select-none">
                            <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Detail Profil Akun</h3>
                        </div>

                        <div class="space-y-4">
                            <!-- Nama Lengkap (Editable) -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                                <input type="text" id="input-name" name="name" value="{{ $user->name }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                    disabled>
                            </div>

                            <!-- Fakultas (Editable) -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Fakultas</label>
                                <input type="text" id="input-faculty" name="faculty" value="{{ $user->faculty }}" placeholder="Masukkan nama fakultas (contoh: Teknik)"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                    disabled>
                            </div>

                            <!-- Program Studi (Editable) -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Program Studi / Prodi</label>
                                <input type="text" id="input-study-program" name="study_program" value="{{ $user->study_program }}" placeholder="Masukkan program studi (contoh: Teknologi Informasi)"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                    disabled>
                            </div>
                            
                            <!-- NIM / NIDN (Readonly) -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    {{ $user->role === 'dosen' ? 'NIDN' : 'NIM' }}
                                </label>
                                <input type="text" value="{{ $user->identity_number }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-400 focus:outline-none cursor-not-allowed select-none opacity-60"
                                    disabled readonly>
                            </div>
                            
                            <!-- Email (Readonly) -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat Email Resmi</label>
                                <input type="email" value="{{ $user->email }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-400 focus:outline-none cursor-not-allowed select-none opacity-60"
                                    disabled readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ubah Kata Sandi Card -->
                <div class="bg-white rounded-[24px] border border-slate-100 p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2.5 mb-6 pb-4 border-b border-slate-50 select-none">
                            <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-500 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Keamanan & Sandi</h3>
                        </div>

                        <div class="space-y-4">
                            <p class="text-xs text-slate-400 font-semibold mb-2 select-none leading-relaxed">Untuk memperbarui kata sandi akun Anda, silakan aktifkan mode edit terlebih dahulu, lalu isi kolom berikut.</p>
                            
                            <!-- Password Baru -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password Baru</label>
                                <input type="password" id="input-password" name="password" placeholder="Biarkan kosong jika tidak diubah"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                    disabled>
                            </div>
                            
                            <!-- Konfirmasi Password -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konfirmasi Password Baru</label>
                                <input type="password" id="input-password-confirmation" name="password_confirmation" placeholder="Biarkan kosong jika tidak diubah"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-75 disabled:cursor-not-allowed"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Save/Cancel Actions (Hidden when not editing) -->
        <div id="save-actions" class="hidden flex gap-3 justify-end pt-2 select-none">
            <button type="button" id="cancel-edit-btn" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-extrabold rounded-xl transition-all duration-200 cursor-pointer">
                Batal
            </button>
            <button type="submit" class="px-7 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-extrabold rounded-xl shadow-md shadow-blue-600/15 hover:shadow-lg transition-all duration-200 cursor-pointer">
                Simpan Perubahan
            </button>
        </div>
    </form>
    
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggle-edit-btn');
        const cancelBtn = document.getElementById('cancel-edit-btn');
        const saveActions = document.getElementById('save-actions');
        
        const inputName = document.getElementById('input-name');
        const inputFaculty = document.getElementById('input-faculty');
        const inputStudyProgram = document.getElementById('input-study-program');
        const inputPassword = document.getElementById('input-password');
        const inputPasswordConfirmation = document.getElementById('input-password-confirmation');
        
        const inputAvatar = document.getElementById('input-avatar');
        const avatarPreview = document.getElementById('avatar-preview');
        const avatarOverlay = document.getElementById('avatar-overlay');
        
        let isEditing = false;

        const defaultAvatarSrc = "{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/profile/ULM PNG.png') }}";
        const defaultAvatarClass = "{{ $user->profile_photo_path ? 'w-full h-full object-cover' : 'w-16 h-16 object-contain' }}";

        function enableEdit() {
            isEditing = true;
            
            // Enable fields
            inputName.removeAttribute('disabled');
            if (inputFaculty) inputFaculty.removeAttribute('disabled');
            if (inputStudyProgram) inputStudyProgram.removeAttribute('disabled');
            inputPassword.removeAttribute('disabled');
            inputPasswordConfirmation.removeAttribute('disabled');
            inputAvatar.removeAttribute('disabled');
            
            // Visual feedback transitions (removes disabled bg and adds white bg)
            inputName.classList.remove('bg-slate-50');
            inputName.classList.add('bg-white');
            if (inputFaculty) {
                inputFaculty.classList.remove('bg-slate-50');
                inputFaculty.classList.add('bg-white');
            }
            if (inputStudyProgram) {
                inputStudyProgram.classList.remove('bg-slate-50');
                inputStudyProgram.classList.add('bg-white');
            }
            inputPassword.classList.remove('bg-slate-50');
            inputPassword.classList.add('bg-white');
            inputPasswordConfirmation.classList.remove('bg-slate-50');
            inputPasswordConfirmation.classList.add('bg-white');
            
            // Show avatar upload overlay
            avatarOverlay.classList.remove('hidden');
            
            // Show save/cancel actions bar
            saveActions.classList.remove('hidden');
            
            // Update Toggle Button label to cancel state
            toggleBtn.className = "flex items-center gap-1.5 px-3.5 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition-all duration-200 cursor-pointer shadow-sm shadow-rose-500/5";
            toggleBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>Batalkan</span>
            `;
        }

        function disableEdit() {
            isEditing = false;
            
            // Disable fields
            inputName.setAttribute('disabled', true);
            if (inputFaculty) inputFaculty.setAttribute('disabled', true);
            if (inputStudyProgram) inputStudyProgram.setAttribute('disabled', true);
            inputPassword.setAttribute('disabled', true);
            inputPasswordConfirmation.setAttribute('disabled', true);
            inputAvatar.setAttribute('disabled', true);
            
            // Restore default placeholder backgrounds
            inputName.classList.add('bg-slate-50');
            inputName.classList.remove('bg-white');
            if (inputFaculty) {
                inputFaculty.classList.add('bg-slate-50');
                inputFaculty.classList.remove('bg-white');
            }
            if (inputStudyProgram) {
                inputStudyProgram.classList.add('bg-slate-50');
                inputStudyProgram.classList.remove('bg-white');
            }
            inputPassword.classList.add('bg-slate-50');
            inputPassword.classList.remove('bg-white');
            inputPasswordConfirmation.classList.add('bg-slate-50');
            inputPasswordConfirmation.classList.remove('bg-white');
            
            // Hide avatar upload overlay & reset input/preview
            avatarOverlay.classList.add('hidden');
            inputAvatar.value = "";
            avatarPreview.src = defaultAvatarSrc;
            avatarPreview.className = defaultAvatarClass;
            
            // Hide save actions bar
            saveActions.classList.add('hidden');
            
            // Restore Toggle Button label to default edit state
            toggleBtn.className = "flex items-center gap-1.5 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-bold rounded-xl transition-all duration-200 cursor-pointer shadow-sm shadow-blue-500/5";
            toggleBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit Profil</span>
            `;
            
            // Reset input values to original
            inputName.value = "{{ $user->name }}";
            if (inputFaculty) inputFaculty.value = "{{ $user->faculty }}";
            if (inputStudyProgram) inputStudyProgram.value = "{{ $user->study_program }}";
            inputPassword.value = "";
            inputPasswordConfirmation.value = "";
        }

        toggleBtn.addEventListener('click', function () {
            if (isEditing) {
                disableEdit();
            } else {
                enableEdit();
            }
        });

        cancelBtn.addEventListener('click', function () {
            disableEdit();
        });

        // Handle Avatar File Upload Click and Preview
        avatarOverlay.addEventListener('click', function () {
            if (isEditing) {
                inputAvatar.click();
            }
        });

        inputAvatar.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    avatarPreview.src = event.target.result;
                    avatarPreview.className = "w-full h-full object-cover";
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
