@extends('layouts.app')

@section('title', 'Kelola Jadwal Akademik - Smart Class Booking')

@section('content')

<!-- Main Container -->
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 mb-10">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 select-none">
        <div class="space-y-1">
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Jadwal Akademik</h1>
            <p class="text-sm text-slate-500">Kelola jadwal kuliah tetap atau penguncian ruangan rutin untuk keperluan akademik fakultas.</p>
        </div>
        <!-- Add Schedule Button (Premium Brand Blue) -->
        <div class="shrink-0">
            <button onclick="openAddModal()" type="button" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black rounded-xl shadow-md transition-all hover:scale-[1.02] cursor-pointer select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Jadwal</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <!-- Success Alert (Matches theme) -->
        <div class="w-full mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 flex items-center justify-between shadow-sm animate-slide-down select-none">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="space-y-0.5">
                    <p class="text-sm font-black">Berhasil!</p>
                    <p class="text-xs font-semibold text-emerald-600">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 cursor-pointer transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="w-full mb-6 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-4 flex items-center justify-between shadow-sm animate-slide-down select-none">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-rose-500 flex items-center justify-center text-white shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="space-y-0.5">
                    <p class="text-sm font-black">Terjadi Kesalahan!</p>
                    <ul class="text-xs font-semibold text-rose-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Search and Filter Panel (Redesigned 2-Row Grid with Kampus, Fakultas & Prodi) -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-6 space-y-5 select-none">
        <!-- Panel Header -->
        <div class="flex items-center justify-between pb-3 border-b border-slate-100/80">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider">Filter & Pencarian Jadwal</h4>
            </div>
            <!-- Reset Button (Visible only when filtering is active) -->
            <button type="button" id="btn-reset-filter" onclick="resetFilters()" class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 hover:bg-slate-100 text-[10px] text-slate-500 hover:text-slate-700 font-extrabold rounded-lg border border-slate-200/60 transition-all duration-200 opacity-0 pointer-events-none cursor-pointer select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5" />
                </svg>
                <span>Reset Filter</span>
            </button>
        </div>

        <!-- Row 1: Search, Campus -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
            <!-- Search Input -->
            <div class="md:col-span-8 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                    Cari Kegiatan atau Ruangan
                </label>
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" id="schedule-search-input" oninput="applyFilters()" placeholder="Ketik nama ruangan, mata kuliah, prodi, atau dosen..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-semibold placeholder:text-slate-400 shadow-inner">
                </div>
            </div>

            <!-- Kampus Filter -->
            <div class="md:col-span-4 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Lokasi
                </label>
                <div class="relative w-full custom-select" id="campus-select-container">
                    <button type="button" class="select-button w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                        <span class="flex items-center gap-2 min-w-0 selected-label">
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="truncate">Pilih Lokasi</span>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="select-menu absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl max-h-60 overflow-y-auto" role="listbox">
                        <div class="p-1.5 space-y-0.5">
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="" data-bullet-color="bg-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                Semua Lokasi
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Banjarmasin" data-bullet-color="bg-blue-500">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                Banjarmasin
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Banjarbaru" data-bullet-color="bg-amber-500">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Banjarbaru
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="filter-campus" value="">
                </div>
            </div>
        </div>

        <!-- Row 2: Faculty, Prodi, Day -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end mt-4 pt-4 border-t border-slate-100/50">
            <!-- Fakultas Filter -->
            <div class="md:col-span-4 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    Fakultas
                </label>
                <div class="relative w-full custom-select" id="faculty-select-container">
                    <button type="button" class="select-button w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                        <span class="flex items-center gap-2 min-w-0 selected-label">
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="truncate">Pilih Fakultas</span>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="select-menu absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl max-h-60 overflow-y-auto" role="listbox">
                        <div class="p-1.5 space-y-0.5">
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="" data-bullet-color="bg-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                Semua Fakultas
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Keguruan dan Ilmu Pendidikan" data-bullet-color="bg-indigo-500">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                Keguruan dan Ilmu Pendidikan (FKIP)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Ekonomi dan Bisnis" data-bullet-color="bg-emerald-500">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Ekonomi dan Bisnis (FEB)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Hukum" data-bullet-color="bg-rose-500">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Hukum (FH)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Ilmu Sosial dan Ilmu Politik" data-bullet-color="bg-purple-500">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                Ilmu Sosial dan Ilmu Politik (FISIP)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kedokteran" data-bullet-color="bg-teal-500">
                                <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                                Kedokteran (FK)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kedokteran Gigi" data-bullet-color="bg-pink-500">
                                <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                                Kedokteran Gigi (FKG)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Matematika dan Ilmu Pengetahuan Alam" data-bullet-color="bg-sky-500">
                                <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                                Matematika dan Ilmu Pengetahuan Alam (FMIPA)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kehutanan" data-bullet-color="bg-amber-700">
                                <span class="w-2 h-2 rounded-full bg-amber-700"></span>
                                Kehutanan (Fahutan)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Pertanian" data-bullet-color="bg-lime-600">
                                <span class="w-2 h-2 rounded-full bg-lime-600"></span>
                                Pertanian (Faperta)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Perikanan dan Kelautan" data-bullet-color="bg-cyan-600">
                                <span class="w-2 h-2 rounded-full bg-cyan-600"></span>
                                Perikanan dan Kelautan (FPK)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Teknik" data-bullet-color="bg-amber-500">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Teknik (FT)
                            </div>
                        </div>
                    </div>
                    <!-- Hidden input managed by JS (triggers handleFacultyFilterChange and applyFilters) -->
                    <input type="hidden" id="filter-faculty" value="">
                </div>
            </div>

            <!-- Prodi Filter -->
            <div class="md:col-span-4 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Program Studi
                </label>
                <div class="relative w-full custom-select" id="prodi-select-container">
                    <button type="button" class="select-button w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                        <span class="flex items-center gap-2 min-w-0 selected-label">
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="truncate">Pilih Program Studi</span>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="select-menu absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl max-h-60 overflow-y-auto" role="listbox">
                        <div class="p-1.5 space-y-0.5 select-menu-options">
                            <!-- Populated Dynamically in JS -->
                        </div>
                    </div>
                    <input type="hidden" id="filter-prodi" value="">
                </div>
            </div>

            <!-- Hari Filter -->
            <div class="md:col-span-4 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                    Hari
                </label>
                <div class="relative w-full custom-select" id="day-select-container">
                    <button type="button" class="select-button w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                        <span class="flex items-center gap-2 min-w-0 selected-label">
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="truncate">Pilih Hari</span>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="select-menu absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl max-h-60 overflow-y-auto" role="listbox">
                        <div class="p-1.5 space-y-0.5">
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="" data-bullet-color="bg-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                Semua Hari
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Senin" data-bullet-color="bg-red-500">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                Senin
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Selasa" data-bullet-color="bg-orange-500">
                                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                Selasa
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Rabu" data-bullet-color="bg-yellow-500">
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                Rabu
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kamis" data-bullet-color="bg-green-500">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                Kamis
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Jumat" data-bullet-color="bg-blue-500">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                Jumat
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Sabtu" data-bullet-color="bg-indigo-500">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                Sabtu
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Minggu" data-bullet-color="bg-purple-500">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                Minggu
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="filter-day" value="">
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card Container -->
    <div class="w-full bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <!-- Table Control Header (Includes Dynamic Counter) -->
        <div class="px-6 py-4 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between select-none">
            <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider">Daftar Jadwal Kuliah</h4>
            <span id="schedule-counter" class="text-[10px] font-black text-slate-400 bg-slate-100 border border-slate-200/60 px-2.5 py-1 rounded-full uppercase tracking-wider">
                Menampilkan {{ count($schedules) }} dari {{ count($schedules) }} Jadwal
            </span>
        </div>
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto w-full">
            <table class="w-full table-fixed text-sm text-left text-slate-500 border-collapse">
                <thead class="text-[10px] text-slate-400 uppercase bg-slate-50/40 border-b border-slate-100 tracking-wider font-black select-none">
                    <tr>
                        <th class="px-6 py-4 w-[20%] min-w-[160px]">Ruangan & Fakultas</th>
                        <th class="px-6 py-4 w-[12%] min-w-[110px]">Lokasi Kampus</th>
                        <th class="px-6 py-4 w-[26%] min-w-[220px]">Nama Kegiatan / Mata Kuliah</th>
                        <th class="px-6 py-4 w-[16%] min-w-[140px]">Dosen / PIC</th>
                        <th class="px-6 py-4 text-center w-[14%] min-w-[120px]">Waktu Rutin</th>
                        <th class="px-6 py-4 text-center w-[12%] min-w-[160px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($schedules as $schedule)
                    @php
                        $badgeClass = match ($schedule->type) {
                            'fixed_class' => 'bg-indigo-50 text-indigo-700 border-indigo-100/80',
                            default => 'bg-amber-50 text-amber-700 border-amber-100/80',
                        };

                        $label = match ($schedule->type) {
                            'fixed_class' => 'Mata Kuliah',
                            default => 'Kegiatan Kampus',
                        };
                    @endphp
                    <tr class="schedule-row hover:bg-slate-50/30 transition-colors" style="display: none;" 
                        data-room="{{ strtolower($schedule->room->name) }}" 
                        data-title="{{ strtolower($schedule->title) }}" 
                        data-lecturer="{{ strtolower($schedule->lecturer_name) }}" 
                        data-day="{{ $schedule->day }}" 
                        data-type="{{ $schedule->type }}"
                        data-campus="{{ $schedule->room->campus }}"
                        data-faculty="{{ $schedule->room->faculty }}"
                        data-prodi="{{ $schedule->prodi ?? '' }}">
                        <!-- Ruangan -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="font-extrabold text-slate-800 text-sm leading-none">{{ $schedule->room->name }}</p>
                            <p class="text-[9px] font-black text-blue-600 uppercase tracking-wider mt-1.5">Fakultas {{ $schedule->room->faculty }}</p>
                        </td>
                        <!-- Lokasi Kampus -->
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-slate-500 text-xs">
                            {{ $schedule->room->campus }}
                        </td>
                        <!-- Judul Kegiatan -->
                        <td class="px-6 py-4">
                            <p class="font-extrabold text-slate-700 text-sm leading-tight">{{ $schedule->title }}</p>
                            @if($schedule->prodi)
                                <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Prodi: {{ $schedule->prodi }}</p>
                            @endif
                        </td>
                        <!-- Dosen / PIC -->
                        <td class="px-6 py-4 font-semibold text-slate-500 text-xs">
                            {{ $schedule->lecturer_name ?? '-' }}
                        </td>
                        <!-- Waktu Rutin -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-xs font-black text-slate-800">{{ $schedule->day }}, {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }} WIB</span>
                        </td>
                        <!-- Dropdown Action -->
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="relative inline-block" id="sched-dropdown-wrap-{{ $schedule->id }}">
                                <!-- Tombol Pilih -->
                                <button
                                    type="button"
                                    onclick="toggleSchedDropdown({{ $schedule->id }})"
                                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-all cursor-pointer select-none shadow-sm"
                                >
                                    <span>Pilih</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform duration-200" id="sched-chevron-{{ $schedule->id }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div
                                    id="sched-dropdown-{{ $schedule->id }}"
                                    class="absolute right-0 z-50 mt-2 w-36 bg-white border border-slate-100 rounded-2xl shadow-xl opacity-0 invisible scale-95 transition-all duration-200 origin-top-right"
                                >
                                    <div class="p-1.5 space-y-0.5">
                                        <!-- Edit -->
                                        <button
                                            onclick="openEditModal({{ json_encode($schedule) }}); closeSchedDropdown({{ $schedule->id }})"
                                            type="button"
                                            class="w-full flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-bold text-blue-700 hover:bg-blue-50 transition-colors cursor-pointer select-none"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                            Edit Jadwal
                                        </button>

                                        <!-- Divider -->
                                        <div class="border-t border-slate-100 my-1"></div>

                                        <!-- Hapus -->
                                        <form action="/admin/schedules/{{ $schedule->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal penguncian ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="w-full flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer select-none"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus Jadwal
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center select-none">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800">Belum Ada Jadwal</h3>
                            <p class="text-sm text-slate-400 mt-1 max-w-xs mx-auto">Silakan tambahkan jadwal tetap akademik atau kunci slot waktu menggunakan tombol Tambah Jadwal.</p>
                        </td>
                    </tr>
                    @endforelse

                    <!-- Filter Empty State Desktop -->
                    <tr id="desktop-empty-state" class="hidden">
                        <td colspan="6" class="px-6 py-16 text-center select-none">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800">Tidak Ada Hasil</h3>
                            <p class="text-sm text-slate-400 mt-1 max-w-xs mx-auto">Tidak ditemukan jadwal/penguncian yang cocok dengan kriteria filter Anda.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse($schedules as $schedule)
            <div class="schedule-card p-5 space-y-4 hover:bg-slate-50/30 transition-colors" style="display: none;" 
                data-room="{{ strtolower($schedule->room->name) }}" 
                data-title="{{ strtolower($schedule->title) }}" 
                data-lecturer="{{ strtolower($schedule->lecturer_name) }}" 
                data-day="{{ $schedule->day }}" 
                data-type="{{ $schedule->type }}"
                data-campus="{{ $schedule->room->campus }}"
                data-faculty="{{ $schedule->room->faculty }}"
                data-prodi="{{ $schedule->prodi ?? '' }}">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <p class="font-extrabold text-slate-800 leading-tight text-base">{{ $schedule->room->name }}</p>
                        <p class="text-[10px] font-bold text-slate-400">Fakultas {{ $schedule->room->faculty }} &bull; {{ $schedule->room->campus }}</p>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Kegiatan / Matakuliah</p>
                        <p class="font-extrabold text-slate-700 mt-0.5">{{ $schedule->title }}</p>
                        @if($schedule->prodi)
                            <p class="text-[10px] font-bold text-slate-450 mt-0.5">Prodi: {{ $schedule->prodi }}</p>
                        @endif
                    </div>
                    @if($schedule->lecturer_name)
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Dosen / PIC</p>
                        <p class="font-bold text-slate-600 mt-0.5">{{ $schedule->lecturer_name }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Waktu Rutin</p>
                        <p class="font-extrabold text-slate-700 mt-0.5">{{ $schedule->day }}, {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }} WIB</p>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                    <!-- Edit Button Mobile -->
                    <button onclick="openEditModal({{ json_encode($schedule) }})" type="button" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-xl transition-all cursor-pointer border border-blue-100/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit
                    </button>
                    <!-- Delete Button Mobile -->
                    <form action="/admin/schedules/{{ $schedule->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition-all cursor-pointer border border-rose-100/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center select-none">
                <p class="text-sm font-bold text-slate-500">Jadwal belum tersedia.</p>
            </div>
            @endforelse

            <!-- Filter Empty State Mobile -->
            <div id="mobile-empty-state" class="p-12 text-center select-none hidden">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-3 border border-slate-100/80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h4 class="text-sm font-extrabold text-slate-800">Tidak Ada Hasil</h4>
                <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">Tidak ditemukan jadwal/penguncian yang cocok dengan kriteria filter Anda.</p>
            </div>
        </div>
    </div>

</div>

<!-- ==================== TAMBAH JADWAL MODAL ==================== -->
<div id="addScheduleModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/40 backdrop-blur-sm">
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-2xl w-full max-w-2xl p-8 mx-4 animate-scale-up max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <h3 class="text-lg font-black text-slate-900 tracking-tight">Tambah Jadwal</h3>
            <button onclick="closeAddModal()" type="button" class="text-slate-400 hover:text-slate-600 transition-colors cursor-pointer focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="/admin/schedules" method="POST" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Column 1: Akademik -->
                <div class="space-y-4">
                    <!-- Fakultas Select -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Pilih Fakultas *</label>
                        <div class="relative">
                            <select id="schedule-faculty-select" required onchange="handleModalFacultyChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                                <option value="" disabled selected>Pilih Fakultas</option>
                                <option value="Keguruan dan Ilmu Pendidikan">Keguruan dan Ilmu Pendidikan (FKIP)</option>
                                <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis (FEB)</option>
                                <option value="Hukum">Hukum (FH)</option>
                                <option value="Ilmu Sosial dan Ilmu Politik">Ilmu Sosial dan Ilmu Politik (FISIP)</option>
                                <option value="Kedokteran">Kedokteran (FK)</option>
                                <option value="Kedokteran Gigi">Kedokteran Gigi (FKG)</option>
                                <option value="Matematika dan Ilmu Pengetahuan Alam">Matematika dan Ilmu Pengetahuan Alam (FMIPA)</option>
                                <option value="Kehutanan">Kehutanan (Fahutan)</option>
                                <option value="Pertanian">Pertanian (Faperta)</option>
                                <option value="Perikanan dan Kelautan">Perikanan dan Kelautan (FPK)</option>
                                <option value="Teknik">Teknik (FT)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Program Studi -->
                    <div id="prodi-container">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Program Studi *</label>
                        <div class="relative">
                            <select name="prodi" id="schedule-prodi-select" required onchange="handleModalProdiChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-slate-50 bg-white">
                                <option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div>

                    <!-- Judul Kegiatan / Mata Kuliah -->
                    <div>
                        <label id="title-label" class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Nama Mata Kuliah *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                            <input type="text" name="title" id="schedule-title-input" required placeholder="Contoh: Pemrograman Web II" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors bg-white placeholder:text-slate-400 placeholder:font-normal">
                        </div>
                    </div>

                    <!-- Nama Dosen -->
                    <div id="lecturer-container">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Nama Dosen Pengajar *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input type="text" name="lecturer_name" id="schedule-lecturer-input" required placeholder="Contoh: M. Rizki, M.Kom." class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors bg-white placeholder:text-slate-400 placeholder:font-normal">
                        </div>
                    </div>
                </div>

                <!-- Column 2: Ruangan & Waktu -->
                <div class="space-y-4">
                    <!-- Kampus Select -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Pilih Kampus *</label>
                        <div class="relative">
                            <select id="schedule-campus-select" onchange="handleModalCampusChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-slate-50 bg-white">
                                <option value="">Semua Lokasi Kampus</option>
                                <option value="Banjarmasin">Banjarmasin</option>
                                <option value="Banjarbaru">Banjarbaru</option>
                            </select>
                        </div>
                    </div>

                    <!-- Ruangan Select -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Pilih Ruangan *</label>
                        <div class="relative">
                            <select name="room_id" id="schedule-room-select" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-slate-50 bg-white">
                                <option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="type" value="fixed_class">

                    <!-- Hari & Waktu -->
                    <div class="grid grid-cols-3 gap-3.5">
                        <!-- Hari Select -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1.5">Hari *</label>
                            <select name="day" required class="w-full px-2.5 py-3 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <!-- Jam Mulai -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1.5">Mulai *</label>
                            <input type="time" name="start_time" required class="w-full px-2.5 py-3 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                        </div>
                        <!-- Jam Selesai -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1.5">Selesai *</label>
                            <input type="time" name="end_time" required class="w-full px-2.5 py-3 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                        </div>
                    </div>

                    <!-- Panduan Jam Kuliah -->
                    <div class="p-4 bg-blue-50/40 border border-blue-100/60 rounded-2xl text-[10px] text-blue-800 font-semibold select-none leading-relaxed flex items-start gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-blue-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="space-y-1.5 w-full">
                            <span class="block text-[10px] font-black text-blue-900 uppercase tracking-wider">Jam Kuliah Standar (1 SKS = 50 Menit):</span>
                            <div class="grid grid-cols-2 gap-x-3 gap-y-0.5 text-slate-500 text-[9px] font-bold">
                                <div>Slot 1: <span class="text-slate-700">08:00 - 08:50</span></div>
                                <div>Slot 5: <span class="text-slate-700">11:20 - 12:10</span></div>
                                <div>Slot 2: <span class="text-slate-700">08:50 - 09:40</span></div>
                                <div>Slot 6: <span class="text-slate-700">13:00 - 13:50</span></div>
                                <div>Slot 3: <span class="text-slate-700">09:40 - 10:30</span></div>
                                <div>Slot 7: <span class="text-slate-700">13:50 - 14:40</span></div>
                                <div>Slot 4: <span class="text-slate-700">10:30 - 11:20</span></div>
                                <div>Slot 8: <span class="text-slate-700">14:40 - 15:30</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-5 border-t border-slate-100">
                <button type="button" onclick="closeAddModal()" class="px-5 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs font-bold rounded-xl border border-slate-200/60 transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black rounded-xl shadow-md transition-colors cursor-pointer">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== EDIT JADWAL MODAL ==================== -->
<div id="editScheduleModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/40 backdrop-blur-sm">
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-2xl w-full max-w-2xl p-8 mx-4 animate-scale-up max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <h3 class="text-lg font-black text-slate-900 tracking-tight">Edit Jadwal</h3>
            <button onclick="closeEditModal()" type="button" class="text-slate-400 hover:text-slate-600 transition-colors cursor-pointer focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="editScheduleForm" action="" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Column 1: Akademik -->
                <div class="space-y-4">
                    <!-- Fakultas Select -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Pilih Fakultas *</label>
                        <div class="relative">
                            <select id="edit-schedule-faculty-select" required onchange="handleEditModalFacultyChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                                <option value="" disabled selected>Pilih Fakultas</option>
                                <option value="Keguruan dan Ilmu Pendidikan">Keguruan dan Ilmu Pendidikan (FKIP)</option>
                                <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis (FEB)</option>
                                <option value="Hukum">Hukum (FH)</option>
                                <option value="Ilmu Sosial dan Ilmu Politik">Ilmu Sosial dan Ilmu Politik (FISIP)</option>
                                <option value="Kedokteran">Kedokteran (FK)</option>
                                <option value="Kedokteran Gigi">Kedokteran Gigi (FKG)</option>
                                <option value="Matematika dan Ilmu Pengetahuan Alam">Matematika dan Ilmu Pengetahuan Alam (FMIPA)</option>
                                <option value="Kehutanan">Kehutanan (Fahutan)</option>
                                <option value="Pertanian">Pertanian (Faperta)</option>
                                <option value="Perikanan dan Kelautan">Perikanan dan Kelautan (FPK)</option>
                                <option value="Teknik">Teknik (FT)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Program Studi -->
                    <div id="edit-prodi-container">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Program Studi *</label>
                        <div class="relative">
                            <select name="prodi" id="edit-schedule-prodi-select" required onchange="handleEditModalProdiChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-slate-50 bg-white">
                                <option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div>

                    <!-- Judul Kegiatan / Mata Kuliah -->
                    <div>
                        <label id="edit-title-label" class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Nama Mata Kuliah *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                            <input type="text" name="title" id="edit-schedule-title-input" required placeholder="Contoh: Pemrograman Web II" class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors bg-white placeholder:text-slate-400 placeholder:font-normal">
                        </div>
                    </div>

                    <!-- Nama Dosen -->
                    <div id="edit-lecturer-container">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Nama Dosen Pengajar *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input type="text" name="lecturer_name" id="edit-schedule-lecturer-input" required placeholder="Contoh: M. Rizki, M.Kom." class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors bg-white placeholder:text-slate-400 placeholder:font-normal">
                        </div>
                    </div>
                </div>

                <!-- Column 2: Ruangan & Waktu -->
                <div class="space-y-4">
                    <!-- Kampus Select -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Pilih Kampus *</label>
                        <div class="relative">
                            <select id="edit-schedule-campus-select" onchange="handleEditModalCampusChange()" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-slate-50 bg-white">
                                <option value="">Semua Lokasi Kampus</option>
                                <option value="Banjarmasin">Banjarmasin</option>
                                <option value="Banjarbaru">Banjarbaru</option>
                            </select>
                        </div>
                    </div>

                    <!-- Ruangan Select -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Pilih Ruangan *</label>
                        <div class="relative">
                            <select name="room_id" id="edit-schedule-room-select" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-slate-50 bg-white">
                                <option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="type" id="edit-schedule-type" value="fixed_class">

                    <!-- Hari & Waktu -->
                    <div class="grid grid-cols-3 gap-3.5">
                        <!-- Hari Select -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1.5">Hari *</label>
                            <select name="day" id="edit-schedule-day-select" required class="w-full px-2.5 py-3 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <!-- Jam Mulai -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1.5">Mulai *</label>
                            <input type="time" name="start_time" id="edit-schedule-start-time" required class="w-full px-2.5 py-3 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                        </div>
                        <!-- Jam Selesai -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1.5">Selesai *</label>
                            <input type="time" name="end_time" id="edit-schedule-end-time" required class="w-full px-2.5 py-3 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-blue-500 transition-colors bg-white">
                        </div>
                    </div>

                    <!-- Panduan Jam Kuliah -->
                    <div class="p-4 bg-blue-50/40 border border-blue-100/60 rounded-2xl text-[10px] text-blue-800 font-semibold select-none leading-relaxed flex items-start gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-blue-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="space-y-1.5 w-full">
                            <span class="block text-[10px] font-black text-blue-900 uppercase tracking-wider">Jam Kuliah Standar (1 SKS = 50 Menit):</span>
                            <div class="grid grid-cols-2 gap-x-3 gap-y-0.5 text-slate-500 text-[9px] font-bold">
                                <div>Slot 1: <span class="text-slate-700">08:00 - 08:50</span></div>
                                <div>Slot 5: <span class="text-slate-700">11:20 - 12:10</span></div>
                                <div>Slot 2: <span class="text-slate-700">08:50 - 09:40</span></div>
                                <div>Slot 6: <span class="text-slate-700">13:00 - 13:50</span></div>
                                <div>Slot 3: <span class="text-slate-700">09:40 - 10:30</span></div>
                                <div>Slot 7: <span class="text-slate-700">13:50 - 14:40</span></div>
                                <div>Slot 4: <span class="text-slate-700">10:30 - 11:20</span></div>
                                <div>Slot 8: <span class="text-slate-700">14:40 - 15:30</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-5 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs font-bold rounded-xl border border-slate-200/60 transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black rounded-xl shadow-md transition-colors cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // --- Schedule Action Dropdown Logic ---
    let activeSchedDropdownId = null;

    function toggleSchedDropdown(id) {
        if (activeSchedDropdownId !== null && activeSchedDropdownId !== id) {
            closeSchedDropdown(activeSchedDropdownId);
        }
        const menu = document.getElementById('sched-dropdown-' + id);
        const chevron = document.getElementById('sched-chevron-' + id);
        const isOpen = !menu.classList.contains('invisible');

        if (isOpen) {
            closeSchedDropdown(id);
        } else {
            menu.classList.remove('opacity-0', 'invisible', 'scale-95');
            menu.classList.add('opacity-100', 'visible', 'scale-100');
            chevron.classList.add('rotate-180');
            activeSchedDropdownId = id;
        }
    }

    function closeSchedDropdown(id) {
        const menu = document.getElementById('sched-dropdown-' + id);
        const chevron = document.getElementById('sched-chevron-' + id);
        if (menu) {
            menu.classList.add('opacity-0', 'invisible', 'scale-95');
            menu.classList.remove('opacity-100', 'visible', 'scale-100');
        }
        if (chevron) {
            chevron.classList.remove('rotate-180');
        }
        if (activeSchedDropdownId === id) activeSchedDropdownId = null;
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (activeSchedDropdownId !== null) {
            const wrap = document.getElementById('sched-dropdown-wrap-' + activeSchedDropdownId);
            if (wrap && !wrap.contains(e.target)) {
                closeSchedDropdown(activeSchedDropdownId);
            }
        }
    });

    // --- Data Mapping ---
    const allRooms = @json($rooms);
    const prodiMap = {
        'Keguruan dan Ilmu Pendidikan': [
            'Pendidikan Matematika',
            'Pendidikan Kimia',
            'Pendidikan Fisika',
            'Pendidikan Biologi',
            'Pendidikan Komputer',
            'Pendidikan IPA',
            'Pendidikan IPS',
            'Pendidikan Sejarah',
            'Pendidikan Pancasila & Kewarganegaraan',
            'Pendidikan Ekonomi',
            'Pendidikan Sosiologi Antropologi',
            'Pendidikan Geografi',
            'Pendidikan Bahasa Indonesia',
            'Pendidikan Bahasa Inggris',
            'Pendidikan Seni Pertunjukan',
            'Pendidikan Jasmani',
            'Bimbingan Konseling',
            'Pendidikan Guru Sekolah Dasar (PGSD)',
            'Pendidikan Guru PAUD (PGPAUD)',
            'Pendidikan Khusus',
            'Teknologi Pendidikan'
        ],
        'Ekonomi dan Bisnis': [
            'Manajemen',
            'Akuntansi',
            'Ilmu Ekonomi dan Studi Pembangunan'
        ],
        'Hukum': [
            'Ilmu Hukum'
        ],
        'Ilmu Sosial dan Ilmu Politik': [
            'Ilmu Pemerintahan',
            'Administrasi Publik',
            'Administrasi Bisnis',
            'Ilmu Komunikasi',
            'Sosiologi',
            'Geografi'
        ],
        'Kedokteran': [
            'Pendidikan Dokter',
            'Kesehatan Masyarakat',
            'Ilmu Keperawatan',
            'Psikologi'
        ],
        'Kedokteran Gigi': [
            'Kedokteran Gigi'
        ],
        'Matematika dan Ilmu Pengetahuan Alam': [
            'Matematika',
            'Kimia',
            'Fisika',
            'Biologi',
            'Farmasi',
            'Ilmu Komputer',
            'Statistika'
        ],
        'Kehutanan': [
            'Kehutanan'
        ],
        'Pertanian': [
            'Agronomi',
            'Agroteknologi',
            'Proteksi Tanaman',
            'Ilmu Tanah',
            'Agribisnis',
            'Peternakan',
            'Teknik Industri Pertanian'
        ],
        'Perikanan dan Kelautan': [
            'Budidaya Perairan',
            'Manajemen Sumberdaya Perairan',
            'Teknologi Hasil Perikanan',
            'Pemanfaatan Sumberdaya Perikanan',
            'Ilmu Kelautan',
            'Agrobisnis Perikanan'
        ],
        'Teknik': [
            'Teknik Sipil',
            'Teknik Arsitektur',
            'Teknik Pertambangan',
            'Teknik Kimia',
            'Teknik Lingkungan',
            'Teknik Mesin',
            'Teknologi Informasi',
            'Teknik Geologi',
            'Rekayasa Elektro',
            'Rekayasa Sistem Komputer'
        ]
    };

    function getFacultyBulletColor(faculty) {
        switch (faculty) {
            case 'Keguruan dan Ilmu Pendidikan': return 'bg-indigo-500';
            case 'Ekonomi dan Bisnis': return 'bg-emerald-500';
            case 'Hukum': return 'bg-rose-500';
            case 'Ilmu Sosial dan Ilmu Politik': return 'bg-purple-500';
            case 'Kedokteran': return 'bg-teal-500';
            case 'Kedokteran Gigi': return 'bg-pink-500';
            case 'Matematika dan Ilmu Pengetahuan Alam': return 'bg-sky-500';
            case 'Kehutanan': return 'bg-amber-700';
            case 'Pertanian': return 'bg-lime-600';
            case 'Perikanan dan Kelautan': return 'bg-cyan-600';
            case 'Teknik': return 'bg-amber-500';
            default: return 'bg-slate-400';
        }
    }

    // --- Dynamic Dropdown Options (Filter Panel) ---
    function handleFacultyFilterChange() {
        const facultyVal = document.getElementById('filter-faculty').value;
        const prodiInput = document.getElementById('filter-prodi');
        const prodiContainer = document.getElementById('prodi-select-container');
        if (!prodiContainer) return;
        const prodiMenuOptions = prodiContainer.querySelector('.select-menu-options');
        const label = prodiContainer.querySelector('.selected-label');

        // Reset label and value of prodi filter
        prodiInput.value = '';
        const selectedFacultyColor = getFacultyBulletColor(facultyVal);
        label.innerHTML = `
            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
            <span class="truncate">Pilih Program Studi</span>
        `;

        prodiMenuOptions.innerHTML = `
            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="" data-bullet-color="bg-slate-400">
                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                Semua Program Studi
            </div>
        `;

        const prodiListToLoad = [];
        if (facultyVal) {
            if (prodiMap[facultyVal]) {
                prodiMap[facultyVal].forEach(prodi => prodiListToLoad.push(prodi));
            }
        } else {
            // Load all prodis alphabetically from all faculties
            const allProdis = new Set();
            for (const key in prodiMap) {
                if (prodiMap.hasOwnProperty(key)) {
                    prodiMap[key].forEach(prodi => allProdis.add(prodi));
                }
            }
            Array.from(allProdis).sort().forEach(prodi => prodiListToLoad.push(prodi));
        }

        prodiListToLoad.forEach(prodi => {
            const opt = document.createElement('div');
            opt.className = "select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap";
            opt.setAttribute('role', 'option');
            opt.setAttribute('data-value', prodi);
            opt.setAttribute('data-bullet-color', selectedFacultyColor);
            opt.innerHTML = `
                <span class="w-2 h-2 rounded-full ${selectedFacultyColor}"></span>
                ${prodi}
            `;
            
            opt.addEventListener('click', (e) => {
                e.stopPropagation();
                const val = opt.getAttribute('data-value');
                const text = opt.innerText.trim();
                const bulletColor = opt.getAttribute('data-bullet-color') || 'bg-slate-400';

                prodiInput.value = val;
                
                label.innerHTML = `
                    <span class="w-2 h-2 rounded-full ${bulletColor} shrink-0"></span>
                    <span class="truncate">${text}</span>
                `;

                const btn = prodiContainer.querySelector('.select-button');
                const menu = prodiContainer.querySelector('.select-menu');
                btn.setAttribute('aria-expanded', 'false');
                menu.classList.add('opacity-0', 'invisible', 'scale-95');
                menu.classList.remove('opacity-100', 'visible', 'scale-100');
                menu.classList.add('pointer-events-none');
                const svg = btn.querySelector('svg');
                if (svg) svg.classList.remove('rotate-180');

                applyFilters();
            });

            prodiMenuOptions.appendChild(opt);
        });
    }

    // Initialize filter prodi list and apply initial empty state on load
    document.addEventListener('DOMContentLoaded', () => {
        handleFacultyFilterChange();
        applyFilters();
    });

    // --- Dynamic Room Suitability Helper ---
    function isRoomSuitableForProdi(roomName, prodiName) {
        const nameLower = roomName.toLowerCase();
        const prodiLower = prodiName.toLowerCase();

        // IT / Komputer majors
        if (nameLower.includes('komputer') || nameLower.includes('it') || nameLower.includes('informatika')) {
            return prodiLower.includes('komputer') || 
                   prodiLower.includes('informasi') || 
                   prodiLower.includes('informatika') || 
                   prodiLower.includes('rekayasa sistem') ||
                   prodiLower.includes('elektro');
        }

        // Kimia / Chemistry majors
        if (nameLower.includes('kimia')) {
            return prodiLower.includes('kimia') || prodiLower.includes('farmasi');
        }

        // Menggambar / Drawing / Architecture majors
        if (nameLower.includes('menggambar') || nameLower.includes('gambar') || nameLower.includes('studio') || nameLower.includes('arsitektur')) {
            return prodiLower.includes('arsitektur') || prodiLower.includes('sipil');
        }

        // Fisika / Physics majors
        if (nameLower.includes('fisika')) {
            return prodiLower.includes('fisika') || prodiLower.includes('ipa');
        }

        // Biologi / Biology majors
        if (nameLower.includes('biologi')) {
            return prodiLower.includes('biologi') || prodiLower.includes('ipa');
        }

        // Non-specialized (general) rooms are suitable for any major
        return true;
    }

    // --- Dynamic Dropdown Options (Add Modal Form) ---
    function handleModalFacultyChange() {
        const facultyVal = document.getElementById('schedule-faculty-select').value;
        const prodiSelect = document.getElementById('schedule-prodi-select');
        const campusSelect = document.getElementById('schedule-campus-select');
        
        // Reset and enable prodi select
        if (facultyVal && prodiMap[facultyVal]) {
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';
            prodiSelect.disabled = false;
            prodiMap[facultyVal].forEach(prodi => {
                const opt = document.createElement('option');
                opt.value = prodi;
                opt.textContent = prodi;
                prodiSelect.appendChild(opt);
            });
        } else {
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>';
            prodiSelect.disabled = true;
        }

        // Reset and enable campus select
        if (facultyVal) {
            campusSelect.value = ""; // Default to all campus
            campusSelect.disabled = false;
        } else {
            campusSelect.value = "";
            campusSelect.disabled = true;
        }

        // Populate and filter rooms (will lock room select until prodi is selected)
        filterRoomsInModal();
    }

    function handleModalProdiChange() {
        filterRoomsInModal();
    }

    function handleModalCampusChange() {
        filterRoomsInModal();
    }

    function filterRoomsInModal() {
        const facultyVal = document.getElementById('schedule-faculty-select').value;
        const prodiVal = document.getElementById('schedule-prodi-select').value;
        const campusVal = document.getElementById('schedule-campus-select').value;
        const roomSelect = document.getElementById('schedule-room-select');

        if (!facultyVal) {
            roomSelect.innerHTML = '<option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>';
            roomSelect.disabled = true;
            return;
        }

        if (!prodiVal) {
            roomSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi Terlebih Dahulu</option>';
            roomSelect.disabled = true;
            return;
        }

        roomSelect.innerHTML = '<option value="" disabled selected>Pilih Ruangan</option>';
        roomSelect.disabled = false;

        // Filter rooms by faculty AND campus (if campus is selected) AND prodi suitability
        const filteredRooms = allRooms.filter(room => {
            const matchesFaculty = room.faculty === facultyVal;
            const matchesCampus = campusVal === '' || room.campus === campusVal;
            const matchesProdi = isRoomSuitableForProdi(room.name, prodiVal);
            return matchesFaculty && matchesCampus && matchesProdi;
        });

        if (filteredRooms.length === 0) {
            const opt = document.createElement('option');
            opt.value = "";
            opt.disabled = true;
            opt.textContent = "Tidak ada ruangan tersedia untuk program studi & lokasi ini";
            roomSelect.appendChild(opt);
        } else {
            filteredRooms.forEach(room => {
                const opt = document.createElement('option');
                opt.value = room.id;
                opt.textContent = `${room.name} (${room.campus})`;
                roomSelect.appendChild(opt);
            });
        }
    }

    // --- Dynamic Dropdown Options (Edit Modal Form) ---
    function handleEditModalFacultyChange(selectedProdi = null, selectedRoomId = null, selectedCampus = null) {
        const facultyVal = document.getElementById('edit-schedule-faculty-select').value;
        const prodiSelect = document.getElementById('edit-schedule-prodi-select');
        const campusSelect = document.getElementById('edit-schedule-campus-select');
        
        // Populate prodi select
        if (facultyVal && prodiMap[facultyVal]) {
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';
            prodiSelect.disabled = false;
            prodiMap[facultyVal].forEach(prodi => {
                const opt = document.createElement('option');
                opt.value = prodi;
                opt.textContent = prodi;
                prodiSelect.appendChild(opt);
            });
            if (selectedProdi) {
                prodiSelect.value = selectedProdi;
            }
        } else {
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>';
            prodiSelect.disabled = true;
        }

        // Enable campus select
        if (facultyVal) {
            campusSelect.disabled = false;
            if (selectedCampus) {
                campusSelect.value = selectedCampus;
            } else if (!selectedRoomId) {
                campusSelect.value = "";
            }
        } else {
            campusSelect.value = "";
            campusSelect.disabled = true;
        }

        // Populate and filter rooms
        filterEditRoomsInModal(selectedRoomId);
    }

    function handleEditModalProdiChange() {
        filterEditRoomsInModal();
    }

    function handleEditModalCampusChange() {
        filterEditRoomsInModal();
    }

    function filterEditRoomsInModal(selectedRoomId = null) {
        const facultyVal = document.getElementById('edit-schedule-faculty-select').value;
        const prodiVal = document.getElementById('edit-schedule-prodi-select').value;
        const campusVal = document.getElementById('edit-schedule-campus-select').value;
        const roomSelect = document.getElementById('edit-schedule-room-select');

        if (!facultyVal) {
            roomSelect.innerHTML = '<option value="" disabled selected>Pilih Fakultas Terlebih Dahulu</option>';
            roomSelect.disabled = true;
            return;
        }

        if (!prodiVal) {
            roomSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi Terlebih Dahulu</option>';
            roomSelect.disabled = true;
            return;
        }

        roomSelect.innerHTML = '<option value="" disabled selected>Pilih Ruangan</option>';
        roomSelect.disabled = false;

        // Filter rooms by faculty AND campus (if campus is selected) AND prodi suitability
        const filteredRooms = allRooms.filter(room => {
            const matchesFaculty = room.faculty === facultyVal;
            const matchesCampus = campusVal === '' || room.campus === campusVal;
            const matchesProdi = isRoomSuitableForProdi(room.name, prodiVal);
            return matchesFaculty && matchesCampus && matchesProdi;
        });

        if (filteredRooms.length === 0) {
            const opt = document.createElement('option');
            opt.value = "";
            opt.disabled = true;
            opt.textContent = "Tidak ada ruangan tersedia untuk program studi & lokasi ini";
            roomSelect.appendChild(opt);
        } else {
            filteredRooms.forEach(room => {
                const opt = document.createElement('option');
                opt.value = room.id;
                opt.textContent = `${room.name} (${room.campus})`;
                roomSelect.appendChild(opt);
            });
            if (selectedRoomId) {
                roomSelect.value = selectedRoomId;
            }
        }
    }

    // --- Search & Filter Logic ---
    function applyFilters() {
        const searchQuery = document.getElementById('schedule-search-input').value.toLowerCase().trim();
        const campusFilter = document.getElementById('filter-campus').value;
        const facultyFilter = document.getElementById('filter-faculty').value;
        const prodiFilter = document.getElementById('filter-prodi').value;
        const dayFilter = document.getElementById('filter-day').value;

        const isFacultySelected = facultyFilter !== '';

        // Count total schedules for the selected faculty
        let facultyTotal = 0;
        document.querySelectorAll('.schedule-row').forEach(row => {
            const faculty = row.getAttribute('data-faculty') || '';
            if (!isFacultySelected || faculty === facultyFilter) {
                facultyTotal++;
            }
        });

        const needsFilter = (searchQuery === '' && campusFilter === '' && facultyFilter === '' && prodiFilter === '' && dayFilter === '');

        // Filter Desktop Rows
        let desktopCount = 0;
        document.querySelectorAll('.schedule-row').forEach(row => {
            const room = row.getAttribute('data-room') || '';
            const title = row.getAttribute('data-title') || '';
            const lecturer = row.getAttribute('data-lecturer') || '';
            
            const campus = row.getAttribute('data-campus') || '';
            const faculty = row.getAttribute('data-faculty') || '';
            const prodi = row.getAttribute('data-prodi') || '';
            const day = row.getAttribute('data-day') || '';

            const matchesSearch = searchQuery === '' || 
                                   room.includes(searchQuery) || 
                                   title.includes(searchQuery) || 
                                   lecturer.includes(searchQuery) ||
                                   prodi.toLowerCase().includes(searchQuery);
                                   
            const matchesCampus = campusFilter === '' || campus === campusFilter;
            const matchesFaculty = facultyFilter === '' || faculty === facultyFilter;
            const matchesProdi = prodiFilter === '' || prodi === prodiFilter;
            const matchesDay = dayFilter === '' || day === dayFilter;

            if (matchesSearch && matchesCampus && matchesFaculty && matchesProdi && matchesDay && !needsFilter) {
                row.style.display = '';
                desktopCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Filter Mobile Cards
        let mobileCount = 0;
        document.querySelectorAll('.schedule-card').forEach(card => {
            const room = card.getAttribute('data-room') || '';
            const title = card.getAttribute('data-title') || '';
            const lecturer = card.getAttribute('data-lecturer') || '';
            
            const campus = card.getAttribute('data-campus') || '';
            const faculty = card.getAttribute('data-faculty') || '';
            const prodi = card.getAttribute('data-prodi') || '';
            const day = card.getAttribute('data-day') || '';

            const matchesSearch = searchQuery === '' || 
                                   room.includes(searchQuery) || 
                                   title.includes(searchQuery) || 
                                   lecturer.includes(searchQuery) ||
                                   prodi.toLowerCase().includes(searchQuery);
                                   
            const matchesCampus = campusFilter === '' || campus === campusFilter;
            const matchesFaculty = facultyFilter === '' || faculty === facultyFilter;
            const matchesProdi = prodiFilter === '' || prodi === prodiFilter;
            const matchesDay = dayFilter === '' || day === dayFilter;

            if (matchesSearch && matchesCampus && matchesFaculty && matchesProdi && matchesDay && !needsFilter) {
                card.style.display = '';
                mobileCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Toggle Empty States
        const desktopEmpty = document.getElementById('desktop-empty-state');
        if (desktopEmpty) {
            if (desktopCount === 0 || needsFilter) {
                desktopEmpty.classList.remove('hidden');
                if (needsFilter) {
                    desktopEmpty.querySelector('h3').textContent = 'Pilih Filter Terlebih Dahulu';
                    desktopEmpty.querySelector('p').textContent = 'Silakan tentukan salah satu filter atau ketik pencarian terlebih dahulu untuk menampilkan daftar jadwal.';
                } else {
                    desktopEmpty.querySelector('h3').textContent = 'Tidak Ada Hasil';
                    desktopEmpty.querySelector('p').textContent = 'Tidak ditemukan jadwal/penguncian yang cocok dengan kriteria filter Anda.';
                }
            } else {
                desktopEmpty.classList.add('hidden');
            }
        }

        const mobileEmpty = document.getElementById('mobile-empty-state');
        if (mobileEmpty) {
            if (mobileCount === 0 || needsFilter) {
                mobileEmpty.classList.remove('hidden');
                if (needsFilter) {
                    mobileEmpty.querySelector('h4').textContent = 'Pilih Filter Terlebih Dahulu';
                    mobileEmpty.querySelector('p').textContent = 'Silakan tentukan salah satu filter atau ketik pencarian terlebih dahulu untuk menampilkan daftar jadwal.';
                } else {
                    mobileEmpty.querySelector('h4').textContent = 'Tidak Ada Hasil';
                    mobileEmpty.querySelector('p').textContent = 'Tidak ditemukan jadwal/penguncian yang cocok dengan kriteria filter Anda.';
                }
            } else {
                mobileEmpty.classList.add('hidden');
            }
        }

        // Update Dynamic Counter
        const displayCount = window.innerWidth >= 768 ? desktopCount : mobileCount;
        const counterEl = document.getElementById('schedule-counter');
        if (counterEl) {
            counterEl.textContent = `Menampilkan ${displayCount} dari ${facultyTotal} Jadwal`;
        }

        // Show/hide Reset button dynamically
        const isFiltering = searchQuery !== '' || campusFilter !== '' || facultyFilter !== '' || prodiFilter !== '' || dayFilter !== '';
        const resetBtn = document.getElementById('btn-reset-filter');
        if (resetBtn) {
            if (isFiltering) {
                resetBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                resetBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        }
    }

    function resetFilters() {
        document.getElementById('schedule-search-input').value = '';
        document.getElementById('filter-campus').value = '';
        document.getElementById('filter-faculty').value = '';
        handleFacultyFilterChange();
        document.getElementById('filter-day').value = '';
        
        // Reset custom selects visual labels
        const campusSelect = document.getElementById('campus-select-container');
        if (campusSelect) {
            campusSelect.querySelector('.selected-label').innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                <span class="truncate">Pilih Lokasi</span>
            `;
        }
        const facultySelect = document.getElementById('faculty-select-container');
        if (facultySelect) {
            facultySelect.querySelector('.selected-label').innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                <span class="truncate">Pilih Fakultas</span>
            `;
        }
        const daySelect = document.getElementById('day-select-container');
        if (daySelect) {
            daySelect.querySelector('.selected-label').innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                <span class="truncate">Pilih Hari</span>
            `;
        }

        applyFilters();
    }

    // --- Modal Controls ---
    const addModal = document.getElementById('addScheduleModal');

    function openAddModal() {
        // Reset form
        const form = document.querySelector('#addScheduleModal form');
        if (form) form.reset();
        
        // Setup initial fields visibility & dynamic list
        document.getElementById('schedule-faculty-select').value = "";
        handleModalFacultyChange();

        addModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeAddModal() {
        addModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close on Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });

    // --- Edit Modal Controls ---
    const editModal = document.getElementById('editScheduleModal');

    function openEditModal(schedule) {
        // Find faculty from the room_id
        const room = allRooms.find(r => r.id == schedule.room_id);
        const faculty = room ? room.faculty : '';
        const campus = room ? room.campus : '';

        // Set faculty select
        document.getElementById('edit-schedule-faculty-select').value = faculty;

        // Trigger change to populate and select prodi and room
        handleEditModalFacultyChange(schedule.prodi, schedule.room_id, campus);

        document.getElementById('edit-schedule-type').value = schedule.type || 'fixed_class';
        document.getElementById('edit-schedule-title-input').value = schedule.title;
        document.getElementById('edit-schedule-lecturer-input').value = schedule.lecturer_name || '';
        document.getElementById('edit-schedule-day-select').value = schedule.day;
        
        // Format times to H:i
        const startTime = schedule.start_time ? schedule.start_time.substring(0, 5) : '';
        const endTime = schedule.end_time ? schedule.end_time.substring(0, 5) : '';
        document.getElementById('edit-schedule-start-time').value = startTime;
        document.getElementById('edit-schedule-end-time').value = endTime;

        // Set form action URL dynamically
        document.getElementById('editScheduleForm').action = '/admin/schedules/' + schedule.id;

        editModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    // --- Custom Select Dropdown Handler ---
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.custom-select').forEach(container => {
            const btn = container.querySelector('.select-button');
            const menu = container.querySelector('.select-menu');
            const input = container.querySelector('input[type="hidden"]');
            const label = container.querySelector('.selected-label');

            if (!btn || !menu || !input) return;

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                
                // Close other dropdowns
                document.querySelectorAll('.custom-select').forEach(other => {
                    if (other !== container) {
                        const otherBtn = other.querySelector('.select-button');
                        const otherMenu = other.querySelector('.select-menu');
                        if (otherBtn && otherMenu) {
                            otherBtn.setAttribute('aria-expanded', 'false');
                            otherMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                            otherMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                            otherMenu.classList.add('pointer-events-none');
                            const svg = otherBtn.querySelector('svg');
                            if (svg) svg.classList.remove('rotate-180');
                        }
                    }
                });

                const isExpanded = btn.getAttribute('aria-expanded') === 'true';
                if (isExpanded) {
                    btn.setAttribute('aria-expanded', 'false');
                    menu.classList.add('opacity-0', 'invisible', 'scale-95');
                    menu.classList.remove('opacity-100', 'visible', 'scale-100');
                    menu.classList.add('pointer-events-none');
                    const svg = btn.querySelector('svg');
                    if (svg) svg.classList.remove('rotate-180');
                } else {
                    btn.setAttribute('aria-expanded', 'true');
                    menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                    menu.classList.add('opacity-100', 'visible', 'scale-100');
                    menu.classList.remove('pointer-events-none');
                    const svg = btn.querySelector('svg');
                    if (svg) svg.classList.add('rotate-180');
                }
            });

            container.querySelectorAll('.select-option').forEach(option => {
                option.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const val = option.getAttribute('data-value');
                    const text = option.innerText.trim();
                    const bulletColor = option.getAttribute('data-bullet-color') || 'bg-slate-400';

                    input.value = val;
                    
                    label.innerHTML = `
                        <span class="w-2 h-2 rounded-full ${bulletColor} shrink-0"></span>
                        <span class="truncate">${text}</span>
                    `;

                    btn.setAttribute('aria-expanded', 'false');
                    menu.classList.add('opacity-0', 'invisible', 'scale-95');
                    menu.classList.remove('opacity-100', 'visible', 'scale-100');
                    menu.classList.add('pointer-events-none');
                    const svg = btn.querySelector('svg');
                    if (svg) svg.classList.remove('rotate-180');

                    // Specialized callback for faculty filter
                    if (input.id === 'filter-faculty') {
                        handleFacultyFilterChange();
                    }

                    // Trigger applyFilters
                    applyFilters();
                });
            });
        });

        // Close on click outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.custom-select').forEach(container => {
                const btn = container.querySelector('.select-button');
                const menu = container.querySelector('.select-menu');
                if (btn && menu) {
                    btn.setAttribute('aria-expanded', 'false');
                    menu.classList.add('opacity-0', 'invisible', 'scale-95');
                    menu.classList.remove('opacity-100', 'visible', 'scale-100');
                    menu.classList.add('pointer-events-none');
                    const svg = btn.querySelector('svg');
                    if (svg) svg.classList.remove('rotate-180');
                }
            });
        });
    });
</script>
@endsection
