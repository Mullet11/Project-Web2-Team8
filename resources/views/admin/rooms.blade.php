@extends('layouts.app')

@section('title', 'Kelola Ruangan - Smart Class Booking')

@section('content')

<!-- Main Container -->
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 mb-10">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 select-none">
        <div class="space-y-1">
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Kelola Ruangan</h1>
            <p class="text-sm text-slate-500">Tambahkan, perbarui, atau hapus data ruangan kelas dan laboratorium yang tersedia di kampus.</p>
        </div>
        <!-- Add Room Button (Premium Brand Blue) -->
        <div class="shrink-0">
            <button onclick="openAddModal()" type="button" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black rounded-xl shadow-md transition-all hover:scale-[1.02] cursor-pointer select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Ruangan</span>
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

    <!-- Search and Filter Panel -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-6 space-y-5 select-none">
        <!-- Panel Header -->
        <div class="flex items-center justify-between pb-3 border-b border-slate-100/80">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider">Filter & Pencarian Ruangan</h4>
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
                    Cari Nama Ruangan
                </label>
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" id="admin-search-input" oninput="applyFilters()" placeholder="Masukkan nama..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-semibold placeholder:text-slate-400 shadow-inner">
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
                    <!-- Options Menu -->
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

        <!-- Row 2: Category, Faculty, Status -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end mt-4 pt-4 border-t border-slate-100/50">
            <!-- Kategori Filter -->
            <div class="md:col-span-4 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                    Kategori
                </label>
                <div class="relative w-full custom-select" id="type-select-container">
                    <button type="button" class="select-button w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                        <span class="flex items-center gap-2 min-w-0 selected-label">
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="truncate">Pilih Kategori</span>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="select-menu absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl max-h-60 overflow-y-auto" role="listbox">
                        <div class="p-1.5 space-y-0.5">
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="" data-bullet-color="bg-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                Semua Kategori
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="kelas" data-bullet-color="bg-purple-500">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                Kelas
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="lab" data-bullet-color="bg-teal-500">
                                <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                                Lab
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="aula" data-bullet-color="bg-rose-500">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Aula
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="theater" data-bullet-color="bg-amber-500">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Theater
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="filter-type" value="">
                </div>
            </div>

            <!-- Fakultas Filter -->
            <div class="md:col-span-4 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
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
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="keguruan dan ilmu pendidikan" data-bullet-color="bg-indigo-500">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                Keguruan dan Ilmu Pendidikan (FKIP)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="ekonomi dan bisnis" data-bullet-color="bg-emerald-500">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Ekonomi dan Bisnis (FEB)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="hukum" data-bullet-color="bg-rose-500">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Hukum (FH)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="ilmu sosial dan ilmu politik" data-bullet-color="bg-purple-500">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                Ilmu Sosial dan Ilmu Politik (FISIP)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="kedokteran" data-bullet-color="bg-teal-500">
                                <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                                Kedokteran (FK)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="kedokteran gigi" data-bullet-color="bg-pink-500">
                                <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                                Kedokteran Gigi (FKG)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="matematika dan ilmu pengetahuan alam" data-bullet-color="bg-sky-500">
                                <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                                Matematika dan Ilmu Pengetahuan Alam (FMIPA)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="kehutanan" data-bullet-color="bg-amber-700">
                                <span class="w-2 h-2 rounded-full bg-amber-700"></span>
                                Kehutanan (Fahutan)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="pertanian" data-bullet-color="bg-lime-600">
                                <span class="w-2 h-2 rounded-full bg-lime-600"></span>
                                Pertanian (Faperta)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="perikanan dan kelautan" data-bullet-color="bg-cyan-600">
                                <span class="w-2 h-2 rounded-full bg-cyan-600"></span>
                                Perikanan dan Kelautan (FPK)
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="teknik" data-bullet-color="bg-amber-500">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Teknik (FT)
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="filter-faculty" value="">
                </div>
            </div>

            <!-- Status Filter -->
            <div class="md:col-span-4 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Status
                </label>
                <div class="relative w-full custom-select" id="status-select-container">
                    <button type="button" class="select-button w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                        <span class="flex items-center gap-2 min-w-0 selected-label">
                            <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                            <span class="truncate">Pilih Status</span>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="select-menu absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl max-h-60 overflow-y-auto" role="listbox">
                        <div class="p-1.5 space-y-0.5">
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="" data-bullet-color="bg-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                Semua Status
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="available" data-bullet-color="bg-emerald-500">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Tersedia
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="occupied" data-bullet-color="bg-rose-500">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Terpakai
                            </div>
                            <div class="select-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="inactive" data-bullet-color="bg-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                Nonaktif
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="filter-status" value="">
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card Container -->
    <div class="w-full bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto w-full">
            <table class="w-full table-fixed text-sm text-left text-slate-500 border-collapse">
                <thead class="text-[10px] text-slate-400 uppercase bg-slate-50/40 border-b border-slate-100 tracking-wider font-black select-none">
                    <tr>
                        <th class="px-6 py-4 w-[20%] min-w-[180px]">Nama Ruangan</th>
                        <th class="px-6 py-4 w-[15%] min-w-[130px]">Lokasi Kampus</th>
                        <th class="px-6 py-4 text-center w-[8%] min-w-[80px]">Kapasitas</th>
                        <th class="px-6 py-4 w-[32%] min-w-[250px]">Fasilitas</th>
                        <th class="px-6 py-4 text-center w-[10%] min-w-[100px]">Status</th>
                        <th class="px-6 py-4 text-center w-[15%] min-w-[160px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($rooms as $room)
                    @php
                        // Determine Category Type
                        $type = 'kelas';
                        if (stripos($room->name, 'Lab') !== false) {
                            $type = 'lab';
                        } elseif (stripos($room->name, 'Aula') !== false) {
                            $type = 'aula';
                        } elseif (stripos($room->name, 'Teater') !== false || stripos($room->name, 'Theater') !== false) {
                            $type = 'theater';
                        }

                        $badgeClass = match ($type) {
                            'lab' => 'bg-emerald-50 text-emerald-700 border-emerald-100/80',
                            'aula' => 'bg-amber-50 text-amber-700 border-amber-100/80',
                            'theater' => 'bg-purple-50 text-purple-700 border-purple-100/80',
                            default => 'bg-indigo-50 text-indigo-700 border-indigo-100/80',
                        };

                        $label = match ($type) {
                            'lab' => 'Lab',
                            'aula' => 'Aula',
                            'theater' => 'Theater',
                            default => 'Kelas',
                        };
                    @endphp
                    <tr class="room-row hover:bg-slate-50/30 transition-colors" style="display: none;" data-name="{{ strtolower($room->name) }}" data-campus="{{ $room->campus }}" data-faculty="{{ strtolower($room->faculty) }}" data-faculty-raw="{{ $room->faculty }}" data-status="{{ $room->status }}" data-type="{{ $type }}">
                        <!-- Nama Ruangan & Category Badge -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-extrabold text-slate-800 text-base">{{ $room->name }}</span>
                                    <span class="inline-block px-2 py-0.5 border text-[9px] font-black rounded-md uppercase tracking-wider select-none {{ $badgeClass }}">
                                        {{ $label }}
                                    </span>
                                </div>
                                <p class="text-xs font-bold text-slate-400">{{ $room->faculty ?? 'Fakultas Teknik' }}</p>
                            </div>
                        </td>
                        <!-- Lokasi Kampus -->
                        <td class="px-6 py-5 whitespace-nowrap font-extrabold text-slate-700">
                            {{ $room->campus }}
                        </td>
                        <!-- Kapasitas -->
                        <td class="px-6 py-5 whitespace-nowrap text-center font-extrabold text-slate-800">
                            {{ $room->capacity }} Kursi
                        </td>
                        <!-- Fasilitas -->
                        <td class="px-6 py-5 max-w-[280px]">
                            <div class="flex flex-wrap gap-1.5">
                                @if($room->facilities)
                                    @foreach(explode(',', $room->facilities) as $facility)
                                        <span class="inline-block px-2.5 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-extrabold rounded-md border border-slate-200/50">
                                            {{ trim($facility) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-slate-400 text-xs font-semibold">Tidak ada fasilitas terdaftar</span>
                                @endif
                            </div>
                        </td>
                        <!-- Status -->
                        <td class="px-6 py-5 whitespace-nowrap text-center">
                            @if($room->status === 'available')
                                <span class="inline-block px-2.5 py-1 bg-emerald-50 border border-emerald-100 text-emerald-600 text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    Tersedia
                                </span>
                            @elseif($room->status === 'occupied')
                                <span class="inline-block px-2.5 py-1 bg-rose-50 border border-rose-100 text-rose-600 text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    Terpakai
                                </span>
                            @else
                                <span class="inline-block px-2.5 py-1 bg-slate-50 border border-slate-200 text-slate-500 text-[10px] font-black rounded-lg uppercase tracking-wider">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <!-- Direct Action Buttons -->
                        <td class="px-6 py-5 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Edit Button -->
                                <button onclick="openEditModal({{ json_encode($room) }})" type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-xl transition-colors cursor-pointer select-none border border-blue-100/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <span>Edit</span>
                                </button>

                                <!-- Delete Button -->
                                <form action="/admin/rooms/{{ $room->id }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini? Semua riwayat terkait juga akan terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition-colors cursor-pointer select-none border border-rose-100/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center select-none">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800">Ruangan Belum Tersedia</h3>
                            <p class="text-sm text-slate-400 mt-1 max-w-xs mx-auto">Silakan tambahkan ruangan baru terlebih dahulu menggunakan tombol Tambah Ruangan.</p>
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
                            <p class="text-sm text-slate-400 mt-1 max-w-xs mx-auto">Tidak ditemukan ruangan yang cocok dengan kriteria filter Anda.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse($rooms as $room)
            @php
                $type = 'kelas';
                if (stripos($room->name, 'Lab') !== false) {
                    $type = 'lab';
                } elseif (stripos($room->name, 'Aula') !== false) {
                    $type = 'aula';
                } elseif (stripos($room->name, 'Teater') !== false || stripos($room->name, 'Theater') !== false) {
                    $type = 'theater';
                }
            @endphp
            <div class="room-card p-5 space-y-4 hover:bg-slate-50/30 transition-colors" style="display: none;" data-name="{{ strtolower($room->name) }}" data-campus="{{ $room->campus }}" data-faculty="{{ strtolower($room->faculty) }}" data-status="{{ $room->status }}" data-type="{{ $type }}">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <p class="font-extrabold text-slate-800 leading-tight text-base">{{ $room->name }}</p>
                        <p class="text-xs font-semibold text-slate-400">{{ $room->faculty ?? 'Fakultas Teknik' }}</p>
                    </div>
                    @if($room->status === 'available')
                        <span class="inline-block px-2 py-0.5 bg-emerald-50 border border-emerald-100 text-emerald-600 text-[10px] font-black rounded-md uppercase tracking-wider">
                            Tersedia
                        </span>
                    @elseif($room->status === 'occupied')
                        <span class="inline-block px-2 py-0.5 bg-rose-50 border border-rose-100 text-rose-600 text-[10px] font-black rounded-md uppercase tracking-wider">
                            Terpakai
                        </span>
                    @else
                        <span class="inline-block px-2 py-0.5 bg-slate-50 border border-slate-200 text-slate-500 text-[10px] font-black rounded-md uppercase tracking-wider">
                            Nonaktif
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Kampus</p>
                        <p class="font-extrabold text-slate-700 mt-0.5">{{ $room->campus }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Kapasitas</p>
                        <p class="font-extrabold text-slate-700 mt-0.5">{{ $room->capacity }} Kursi</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px] mb-1">Fasilitas</p>
                        <div class="flex flex-wrap gap-1">
                            @if($room->facilities)
                                @foreach(explode(',', $room->facilities) as $facility)
                                    <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 text-[9px] font-bold rounded-md">
                                        {{ trim($facility) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-slate-400 text-xs font-semibold">Tidak ada fasilitas</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="openEditModal({{ json_encode($room) }})" type="button" class="px-3.5 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold rounded-xl transition-all cursor-pointer border border-blue-100/30">
                        Edit
                    </button>
                    <form action="/admin/rooms/{{ $room->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3.5 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold rounded-xl transition-all cursor-pointer border border-rose-100/30">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center select-none">
                <p class="text-sm font-bold text-slate-500">Ruangan belum tersedia.</p>
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
                <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">Tidak ditemukan ruangan yang cocok dengan kriteria filter Anda.</p>
            </div>
        </div>
    </div>

</div>

<!-- ==================== TAMBAH RUANGAN MODAL ==================== -->
<div id="addRoomModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/40 backdrop-blur-sm">
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-2xl w-full max-w-lg p-8 mx-4 animate-scale-up max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <h3 class="text-lg font-black text-slate-900 tracking-tight">Tambah Ruangan Baru</h3>
            <button onclick="closeAddModal()" type="button" class="text-slate-400 hover:text-slate-600 transition-colors cursor-pointer focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="/admin/rooms" method="POST" class="space-y-4" onsubmit="compileFacilities('add')">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Nama Ruangan *</label>
                    <input type="text" name="name" required placeholder="Contoh: Ruang Kuliah 1" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Tipe Ruangan *</label>
                    <select name="building" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="kelas">Ruang Kelas</option>
                        <option value="lab">Laboratorium</option>
                        <option value="aula">Aula</option>
                        <option value="theater">Theater</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Lokasi *</label>
                    <select name="campus" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="" disabled selected>Pilih Lokasi</option>
                        <option value="Banjarmasin">Banjarmasin</option>
                        <option value="Banjarbaru">Banjarbaru</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Kapasitas *</label>
                    <input type="number" name="capacity" required min="1" placeholder="30" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Fakultas *</label>
                    <select name="faculty" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
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
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Status *</label>
                    <select name="status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="available">Tersedia</option>
                        <option value="occupied">Terpakai</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- Structured Facilities Selection -->
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Fasilitas Ruangan (Centang yang tersedia)</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 bg-slate-50 p-4 rounded-2xl border border-slate-200/50 mb-3">
                    <!-- AC -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="add_fac_ac" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>AC</span>
                    </label>
                    <!-- Proyektor -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="add_fac_proyektor" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Proyektor</span>
                    </label>
                    <!-- Papan Tulis -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="add_fac_papan" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Papan Tulis</span>
                    </label>
                    <!-- PC Komputer -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="add_fac_pc" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Komputer (PC)</span>
                    </label>
                    <!-- Sound System -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="add_fac_sound" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Sound System</span>
                    </label>
                    <!-- Kursi Lipat -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="add_fac_kursi" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Kursi Lipat</span>
                    </label>
                </div>

                <!-- Hidden inputs to submit compiled text -->
                <input type="hidden" id="add_facilities_compiled" name="facilities">
                
                <!-- Textbox for other custom facilities -->
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Fasilitas Lainnya (Ketik Manual & Koma)</label>
                <input type="text" id="add_fac_others" placeholder="Contoh: Meja Gambar, Exhaust Fan" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 bg-slate-50 transition-colors">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeAddModal()" class="px-5 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs font-bold rounded-xl border border-slate-200/60 transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black rounded-xl shadow-md transition-colors cursor-pointer">
                    Simpan Ruangan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== EDIT RUANGAN MODAL ==================== -->
<div id="editRoomModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-900/40 backdrop-blur-sm">
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-2xl w-full max-w-lg p-8 mx-4 animate-scale-up max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
            <h3 class="text-lg font-black text-slate-900 tracking-tight">Edit Detail Ruangan</h3>
            <button onclick="closeEditModal()" type="button" class="text-slate-400 hover:text-slate-600 transition-colors cursor-pointer focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="editRoomForm" action="" method="POST" class="space-y-4" onsubmit="compileFacilities('edit')">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Nama Ruangan *</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Tipe Ruangan *</label>
                    <select id="edit_building" name="building" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="kelas">Ruang Kelas</option>
                        <option value="lab">Laboratorium</option>
                        <option value="aula">Aula</option>
                        <option value="theater">Theater</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Lokasi *</label>
                    <select id="edit_campus" name="campus" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="" disabled>Pilih Lokasi</option>
                        <option value="Banjarmasin">Banjarmasin</option>
                        <option value="Banjarbaru">Banjarbaru</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Kapasitas *</label>
                    <input type="number" id="edit_capacity" name="capacity" required min="1" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Fakultas *</label>
                    <select id="edit_faculty" name="faculty" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="" disabled>Pilih Fakultas</option>
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
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Status *</label>
                    <select id="edit_status" name="status" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 transition-colors">
                        <option value="available">Tersedia</option>
                        <option value="occupied">Terpakai</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- Structured Facilities Selection (Edit) -->
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Fasilitas Ruangan (Centang yang tersedia)</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 bg-slate-50 p-4 rounded-2xl border border-slate-200/50 mb-3">
                    <!-- AC -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="edit_fac_ac" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>AC</span>
                    </label>
                    <!-- Proyektor -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="edit_fac_proyektor" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Proyektor</span>
                    </label>
                    <!-- Papan Tulis -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="edit_fac_papan" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Papan Tulis</span>
                    </label>
                    <!-- PC Komputer -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="edit_fac_pc" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Komputer (PC)</span>
                    </label>
                    <!-- Sound System -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="edit_fac_sound" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Sound System</span>
                    </label>
                    <!-- Kursi Lipat -->
                    <label class="flex items-center gap-2 text-sm font-bold text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" id="edit_fac_kursi" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span>Kursi Lipat</span>
                    </label>
                </div>

                <!-- Hidden inputs to submit compiled text -->
                <input type="hidden" id="edit_facilities_compiled" name="facilities">
                
                <!-- Textbox for other custom facilities -->
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Fasilitas Lainnya (Ketik Manual & Koma)</label>
                <input type="text" id="edit_fac_others" placeholder="Contoh: Meja Gambar, Exhaust Fan" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold focus:outline-none focus:border-blue-500 bg-slate-50 transition-colors">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
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
    // --- Search & Filter Logic ---
    function applyFilters() {
        const searchQuery = document.getElementById('admin-search-input').value.toLowerCase().trim();
        const campusFilter = document.getElementById('filter-campus').value;
        const typeFilter = document.getElementById('filter-type').value;
        const facultyFilter = document.getElementById('filter-faculty').value;
        const statusFilter = document.getElementById('filter-status').value;

        const desktopEmpty = document.getElementById('desktop-empty-state');
        const mobileEmpty = document.getElementById('mobile-empty-state');

        const needsFilter = (searchQuery === '' && campusFilter === '' && typeFilter === '' && facultyFilter === '' && statusFilter === '');

        let desktopCount = 0;
        let mobileCount = 0;

        if (needsFilter) {
            // Hide all desktop rows
            document.querySelectorAll('.room-row').forEach(row => {
                row.style.display = 'none';
            });
            // Hide all mobile cards
            document.querySelectorAll('.room-card').forEach(card => {
                card.style.display = 'none';
            });

            // Update messages
            if (desktopEmpty) {
                desktopEmpty.querySelector('h3').textContent = 'Pilih Filter Terlebih Dahulu';
                desktopEmpty.querySelector('p').textContent = 'Silakan tentukan salah satu filter atau ketik pencarian terlebih dahulu untuk menampilkan daftar ruangan.';
            }
            if (mobileEmpty) {
                mobileEmpty.querySelector('h4').textContent = 'Pilih Filter Terlebih Dahulu';
                mobileEmpty.querySelector('p').textContent = 'Silakan tentukan salah satu filter atau ketik pencarian terlebih dahulu untuk menampilkan daftar ruangan.';
            }
        } else {
            // Filter Desktop Rows
            document.querySelectorAll('.room-row').forEach(row => {
                const name = row.getAttribute('data-name');
                const campus = row.getAttribute('data-campus');
                const type = row.getAttribute('data-type');
                const faculty = row.getAttribute('data-faculty');
                const status = row.getAttribute('data-status');

                const matchesSearch = name.includes(searchQuery);
                const matchesCampus = campusFilter === '' || campus === campusFilter;
                const matchesType = typeFilter === '' || type === typeFilter;
                const matchesFaculty = facultyFilter === '' || faculty === facultyFilter;
                const matchesStatus = statusFilter === '' || status === statusFilter;

                if (matchesSearch && matchesCampus && matchesType && matchesFaculty && matchesStatus) {
                    row.style.display = '';
                    desktopCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter Mobile Cards
            document.querySelectorAll('.room-card').forEach(card => {
                const name = card.getAttribute('data-name');
                const campus = card.getAttribute('data-campus');
                const type = card.getAttribute('data-type');
                const faculty = card.getAttribute('data-faculty');
                const status = card.getAttribute('data-status');

                const matchesSearch = name.includes(searchQuery);
                const matchesCampus = campusFilter === '' || campus === campusFilter;
                const matchesType = typeFilter === '' || type === typeFilter;
                const matchesFaculty = facultyFilter === '' || faculty === facultyFilter;
                const matchesStatus = statusFilter === '' || status === statusFilter;

                if (matchesSearch && matchesCampus && matchesType && matchesFaculty && matchesStatus) {
                    card.style.display = '';
                    mobileCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Restore messages
            if (desktopEmpty) {
                desktopEmpty.querySelector('h3').textContent = 'Tidak Ada Hasil';
                desktopEmpty.querySelector('p').textContent = 'Tidak ditemukan ruangan yang cocok dengan kriteria filter Anda.';
            }
            if (mobileEmpty) {
                mobileEmpty.querySelector('h4').textContent = 'Tidak Ada Hasil';
                mobileEmpty.querySelector('p').textContent = 'Tidak ditemukan ruangan yang cocok dengan kriteria filter Anda.';
            }
        }

        // Toggle Desktop Empty State
        if (desktopEmpty) {
            if (desktopCount === 0 || needsFilter) {
                desktopEmpty.classList.remove('hidden');
            } else {
                desktopEmpty.classList.add('hidden');
            }
        }

        // Toggle Mobile Empty State
        if (mobileEmpty) {
            if (mobileCount === 0 || needsFilter) {
                mobileEmpty.classList.remove('hidden');
            } else {
                mobileEmpty.classList.add('hidden');
            }
        }

        // Show/hide Reset button dynamically
        const isFiltering = searchQuery !== '' || campusFilter !== '' || typeFilter !== '' || facultyFilter !== '' || statusFilter !== '';
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
        document.getElementById('admin-search-input').value = '';
        document.getElementById('filter-campus').value = '';
        document.getElementById('filter-type').value = '';
        document.getElementById('filter-faculty').value = '';
        document.getElementById('filter-status').value = '';
        
        // Reset custom selects visual labels
        const campusSelect = document.getElementById('campus-select-container');
        if (campusSelect) {
            campusSelect.querySelector('.selected-label').innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                <span class="truncate">Pilih Lokasi</span>
            `;
        }
        const typeSelect = document.getElementById('type-select-container');
        if (typeSelect) {
            typeSelect.querySelector('.selected-label').innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                <span class="truncate">Pilih Kategori</span>
            `;
        }
        const facultySelect = document.getElementById('faculty-select-container');
        if (facultySelect) {
            facultySelect.querySelector('.selected-label').innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                <span class="truncate">Pilih Fakultas</span>
            `;
        }
        const statusSelect = document.getElementById('status-select-container');
        if (statusSelect) {
            statusSelect.querySelector('.selected-label').innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                <span class="truncate">Pilih Status</span>
            `;
        }

        applyFilters();
    }

    // --- Modal Controls ---
    const addModal = document.getElementById('addRoomModal');
    const editModal = document.getElementById('editRoomModal');

    function openAddModal() {
        // Reset form fields to defaults
        const form = document.querySelector('#addRoomModal form');
        if (form) form.reset();
        
        // Reset add checkboxes
        const items = ['ac', 'proyektor', 'papan', 'pc', 'sound', 'kursi'];
        items.forEach(item => {
            document.getElementById(`add_fac_${item}`).checked = false;
        });
        document.getElementById('add_fac_others').value = '';
        
        addModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeAddModal() {
        addModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function openEditModal(room) {
        // Pre-fill input elements
        document.getElementById('edit_name').value = room.name;
        document.getElementById('edit_campus').value = room.campus;
        document.getElementById('edit_capacity').value = room.capacity;
        document.getElementById('edit_faculty').value = room.faculty || 'Teknik';
        document.getElementById('edit_status').value = room.status;
        document.getElementById('edit_building').value = room.building || 'kelas';
        
        // Reset all edit checkboxes
        const items = ['ac', 'proyektor', 'papan', 'pc', 'sound', 'kursi'];
        items.forEach(item => {
            document.getElementById(`edit_fac_${item}`).checked = false;
        });
        document.getElementById('edit_fac_others').value = '';

        // Parse facilities string from database (clearing out any old quantity prefixes)
        const facString = room.facilities || '';
        if (facString) {
            const parts = facString.split(',').map(p => p.trim());
            let othersParts = [];

            parts.forEach(part => {
                // Strip leading quantities if any (e.g. "2 AC" -> "AC") for compatibility
                const cleanPart = part.replace(/^\d+\s+/, '').trim();
                const label = cleanPart.toLowerCase();
                let key = '';

                if (label.includes('ac')) key = 'ac';
                else if (label.includes('proyektor')) key = 'proyektor';
                else if (label.includes('papan') || label.includes('tulis')) key = 'papan';
                else if (label.includes('pc') || label.includes('komputer')) key = 'pc';
                else if (label.includes('sound')) key = 'sound';
                else if (label.includes('kursi')) key = 'kursi';

                if (key) {
                    document.getElementById(`edit_fac_${key}`).checked = true;
                } else {
                    othersParts.push(part);
                }
            });

            document.getElementById('edit_fac_others').value = othersParts.join(', ');
        }

        // Dynamically change form action URL
        document.getElementById('editRoomForm').action = '/admin/rooms/' + room.id;

        editModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close modals on escape key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });

    // --- Facilities Compiler/Parser Helpers ---
    function compileFacilities(prefix) {
        const items = [
            { key: 'ac', label: 'AC' },
            { key: 'proyektor', label: 'Proyektor' },
            { key: 'papan', label: 'Papan Tulis' },
            { key: 'pc', label: 'PC Komputer' },
            { key: 'sound', label: 'Sound System' },
            { key: 'kursi', label: 'Kursi Lipat' }
        ];

        let parts = [];
        items.forEach(item => {
            const cb = document.getElementById(`${prefix}_fac_${item.key}`);
            if (cb && cb.checked) {
                parts.push(item.label);
            }
        });

        const othersVal = document.getElementById(`${prefix}_fac_others`).value.trim();
        if (othersVal) {
            parts.push(othersVal);
        }

        document.getElementById(`${prefix}_facilities_compiled`).value = parts.join(', ');
    }

    // --- Custom Select Dropdown Handler ---
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.custom-select').forEach(container => {
            const btn = container.querySelector('.select-button');
            const menu = container.querySelector('.select-menu');
            const input = container.querySelector('input[type="hidden"]');
            const label = container.querySelector('.selected-label');

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                
                // Close other dropdowns
                document.querySelectorAll('.custom-select').forEach(other => {
                    if (other !== container) {
                        const otherBtn = other.querySelector('.select-button');
                        const otherMenu = other.querySelector('.select-menu');
                        otherBtn.setAttribute('aria-expanded', 'false');
                        otherMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                        otherMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                        otherMenu.classList.add('pointer-events-none');
                        const svg = otherBtn.querySelector('svg');
                        if (svg) svg.classList.remove('rotate-180');
                    }
                });

                const isExpanded = btn.getAttribute('aria-expanded') === 'true';
                if (isExpanded) {
                    btn.setAttribute('aria-expanded', 'false');
                    menu.classList.add('opacity-0', 'invisible', 'scale-95');
                    menu.classList.remove('opacity-100', 'visible', 'scale-100');
                    menu.classList.add('pointer-events-none');
                    btn.querySelector('svg').classList.remove('rotate-180');
                } else {
                    btn.setAttribute('aria-expanded', 'true');
                    menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                    menu.classList.add('opacity-100', 'visible', 'scale-100');
                    menu.classList.remove('pointer-events-none');
                    btn.querySelector('svg').classList.add('rotate-180');
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
                    btn.querySelector('svg').classList.remove('rotate-180');

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
                btn.setAttribute('aria-expanded', 'false');
                menu.classList.add('opacity-0', 'invisible', 'scale-95');
                menu.classList.remove('opacity-100', 'visible', 'scale-100');
                menu.classList.add('pointer-events-none');
                const svg = btn.querySelector('svg');
                if (svg) svg.classList.remove('rotate-180');
            });
        });

        // Initialize filtering on page load
        applyFilters();
    });
</script>
@endsection
