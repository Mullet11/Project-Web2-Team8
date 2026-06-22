@extends('layouts.app')

@section('title', 'Dashboard - Smart Class Booking')

@section('content')

<!-- Page Header -->
<div class="mb-8 select-none">
    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Dashboard Utama</h1>
    <p class="text-sm text-slate-500 mt-1">Cari, telusuri, dan booking ruangan kelas atau laboratorium di seluruh lingkungan kampus.</p>
</div>

<!-- Search and Filters Panel -->
<div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-8 space-y-5 select-none">
    <!-- Panel Header -->
    <div class="flex items-center justify-between pb-3 border-b border-slate-100/80">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider">Cari & Booking Ruangan</h4>
        </div>
        <!-- Reset Button (Visible only when filtering is active) -->
        <button type="button" id="btn-reset-filter" class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 hover:bg-slate-100 text-[10px] text-slate-500 hover:text-slate-700 font-extrabold rounded-lg border border-slate-200/60 transition-all duration-200 opacity-0 pointer-events-none cursor-pointer select-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5" />
            </svg>
            <span>Reset Filter</span>
        </button>
    </div>

    <!-- Grid: Search, Campus, Faculty, Status -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
        <!-- Search bar -->
        <div class="lg:col-span-4 md:col-span-6 col-span-12 space-y-2">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                Cari Ruangan
            </label>
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" id="search-input" placeholder="Cari nama atau nomor ruangan..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-semibold placeholder:text-slate-400 shadow-inner">
            </div>
        </div>

        <!-- Kampus Filter -->
        <div class="lg:col-span-3 md:col-span-6 col-span-12 space-y-2">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                Lokasi Kampus
            </label>
            <!-- Dropdown Campus Filter (Premium Custom Select) -->
            <div class="relative w-full" id="campus-dropdown">
                <button type="button" id="campus-dropdown-button" class="w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                    <span class="flex items-center gap-2 min-w-0" id="campus-selected-label">
                        <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                        <span class="truncate">Pilih Lokasi Kampus</span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu Options -->
                <div id="campus-dropdown-menu" class="absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl" role="listbox">
                    <div class="p-1.5 space-y-0.5">
                        <div class="campus-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                            Pilih Lokasi Kampus
                        </div>
                        <div class="campus-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kampus Banjarmasin">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            Kampus Banjarmasin
                        </div>
                        <div class="campus-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kampus Banjarbaru">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Kampus Banjarbaru
                        </div>
                    </div>
                </div>
                <input type="hidden" name="campus" id="campus-filter-input" value="">
            </div>
        </div>

        <!-- Fakultas Filter -->
        <div class="lg:col-span-3 md:col-span-6 col-span-12 space-y-2">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                Fakultas
            </label>
            <!-- Dropdown Faculty Filter (Premium Custom Select) -->
            <div class="relative w-full" id="faculty-dropdown">
                <button type="button" id="faculty-dropdown-button" class="w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                    <span class="flex items-center gap-2 min-w-0" id="faculty-selected-label">
                        <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                        <span class="truncate">Pilih Fakultas</span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu Options -->
                <div id="faculty-dropdown-menu" class="absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none max-h-60 overflow-y-auto shadow-xl" role="listbox">
                    <div class="p-1.5 space-y-0.5">
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                            Pilih Fakultas
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Keguruan dan Ilmu Pendidikan">
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            Keguruan dan Ilmu Pendidikan (FKIP)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Ekonomi dan Bisnis">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Ekonomi dan Bisnis (FEB)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Hukum">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            Hukum (FH)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Ilmu Sosial dan Ilmu Politik">
                            <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                            Ilmu Sosial dan Ilmu Politik (FISIP)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kedokteran">
                            <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                            Kedokteran (FK)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kedokteran Gigi">
                            <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                            Kedokteran Gigi (FKG)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Matematika dan Ilmu Pengetahuan Alam">
                            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                            Matematika dan Ilmu Pengetahuan Alam (FMIPA)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Kehutanan">
                            <span class="w-2 h-2 rounded-full bg-amber-700"></span>
                            Kehutanan (Fahutan)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Pertanian">
                            <span class="w-2 h-2 rounded-full bg-lime-600"></span>
                            Pertanian (Faperta)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Perikanan dan Kelautan">
                            <span class="w-2 h-2 rounded-full bg-cyan-600"></span>
                            Perikanan dan Kelautan (FPK)
                        </div>
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-650 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="Teknik">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Teknik (FT)
                        </div>
                    </div>
                </div>
                <input type="hidden" name="faculty" id="faculty-filter-input" value="">
            </div>
        </div>

        <!-- Status Filter -->
        <div class="lg:col-span-2 md:col-span-6 col-span-12 space-y-2">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Status Ruangan
            </label>
            <!-- Dropdown Status Filter (Premium Custom Select) -->
            <div class="relative w-full" id="status-dropdown">
                <button type="button" id="status-dropdown-button" class="w-full flex items-center justify-between px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-xs sm:text-sm font-bold text-slate-650 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5 min-w-0 overflow-hidden" aria-haspopup="listbox" aria-expanded="false">
                    <span class="flex items-center gap-2 min-w-0" id="status-selected-label">
                        <span class="w-2 h-2 rounded-full bg-slate-400 shrink-0"></span>
                        <span class="truncate">Semua Status</span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu Options -->
                <div id="status-dropdown-menu" class="absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none shadow-xl" role="listbox">
                    <div class="p-1.5 space-y-0.5">
                        <div class="status-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors" role="option" data-value="all" data-color="bg-slate-400">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                            Semua Status
                        </div>
                        <div class="status-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-teal-600 rounded-xl cursor-pointer hover:bg-teal-50/50 transition-colors" role="option" data-value="tersedia" data-color="bg-emerald-500">
                            <span class="relative flex h-2 w-2 shrink-0">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            Tersedia
                        </div>
                        <div class="status-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-rose-600 rounded-xl cursor-pointer hover:bg-rose-50/50 transition-colors" role="option" data-value="terpakai" data-color="bg-rose-500">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            Terpakai
                        </div>
                    </div>
                </div>
                <input type="hidden" name="status" id="status-filter-input" value="all">
            </div>
        </div>
    </div>
    <!-- Divider Line Type -->
    <div class="border-t border-slate-100 hidden" id="type-filters-divider"></div>
    <!-- Bottom Row: Horizontal Type Tabs -->
    <div class="flex flex-col gap-2 hidden" id="type-filters-section">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-2.5 w-full" id="type-tabs-container">
            <button type="button" data-type="all" class="type-tab col-span-2 md:col-span-1 w-full flex items-center justify-center py-3 px-4 bg-blue-600 text-white text-xs font-bold rounded-xl transition-all whitespace-nowrap shadow-md shadow-blue-500/10 cursor-pointer border-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Semua
            </button>
            <button type="button" data-type="kelas" class="type-tab col-span-1 w-full flex items-center justify-center py-3 px-4 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-900 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-200/60 shadow-sm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Ruang kelas
            </button>
            <button type="button" data-type="lab" class="type-tab col-span-1 w-full flex items-center justify-center py-3 px-4 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-900 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-200/60 shadow-sm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                Laboratorium
            </button>
            <button type="button" data-type="aula" class="type-tab col-span-1 w-full flex items-center justify-center py-3 px-4 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-900 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-200/60 shadow-sm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Aula
            </button>
            <button type="button" data-type="theater" class="type-tab col-span-1 w-full flex items-center justify-center py-3 px-4 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-900 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-200/60 shadow-sm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                Theater
            </button>
        </div>
    </div>
</div>

<!-- Rooms Grid Section (Mockup Style) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="rooms-grid">

    @foreach ($rooms as $room)
    <div class="room-card bg-white rounded-[24px] border border-slate-100 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group h-[400px]" data-status="{{ $room->data_status }}" data-building="{{ $room->data_building }}" data-type="{{ $room->data_type }}" data-name="{{ $room->data_name }}" data-campus="{{ $room->campus }}" data-faculty="{{ $room->data_faculty }}" style="display: none;">
        <!-- Top Half: Image Placeholder -->
        <div class="h-44 w-full bg-gradient-to-br {{ $room->image_bg_gradient }} rounded-t-[24px] flex items-center justify-center relative overflow-hidden shrink-0 border-b border-slate-100/50">
            <!-- Faculty Badge Overlay -->
            <span class="absolute top-4 left-4 px-3 py-1 bg-slate-900/60 backdrop-blur-sm text-white text-[10px] font-black rounded-lg select-none tracking-wider z-10 uppercase">
                Fakultas {{ $room->faculty }}
            </span>
            <!-- Category Badge Overlay -->
            <span class="absolute top-4 right-4 px-3 py-1 {{ $room->category_badge_class }} text-[10px] font-black rounded-lg select-none tracking-wider z-10 shadow-sm uppercase">
                {{ $room->type_label }}
            </span>
            @if($room->data_status === 'tersedia')
            <div class="absolute inset-0 flex items-center justify-center opacity-20 select-none pointer-events-none">
                <svg viewBox="0 0 24 24" fill="none" class="w-16 h-16 text-blue-600/30" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
            @endif
            <span class="text-[10px] font-bold text-slate-400/80 uppercase tracking-widest">[ Image Placeholder ]</span>
        </div>
        <!-- Bottom Half: Details Section -->
        <div class="p-6 text-white {{ $room->content_bg_color }} rounded-b-[24px] flex flex-col justify-between flex-grow">
            <!-- Info & Status Badge -->
            <div class="flex justify-between items-start gap-4">
                <div class="overflow-hidden">
                    <h4 class="text-xl font-extrabold tracking-tight truncate">{{ $room->name }}</h4>
                    <p class="text-xs {{ $room->subtext_class }} font-semibold truncate mt-1">{{ $room->faculty }} &bull; {{ $room->type_label }} &bull; {{ $room->location_label }}</p>
                    <p class="text-[10px] {{ $room->subtext_class }} font-bold truncate mt-0.5 opacity-80">Kapasitas: {{ $room->capacity }} Kursi</p>
                </div>
                <span class="px-3 py-1 bg-white {{ $room->badge_text_color }} text-xs font-bold rounded-xl shrink-0 select-none">
                    {{ $room->badge_text }}
                </span>
            </div>
            <!-- Action Buttons -->
            <div class="flex flex-col gap-2 mt-4 shrink-0 select-none">
                <a href="{{ $room->button_url }}" class="w-full py-2.5 {{ $room->button_class }} text-xs font-bold rounded-xl text-center transition-all duration-200">
                    {{ $room->button_text }}
                </a>
                <a href="/rooms/{{ $room->id }}/agenda" class="block w-full py-2 text-white/80 hover:text-white text-xs font-semibold rounded-xl text-center transition-all duration-200 border border-white/20 hover:border-white/40">
                    Lihat Agenda Hari Ini
                </a>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Filter Instruction (Shown by default since no campus/faculty is selected) -->
    <div id="filter-instruction" class="col-span-full py-16 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500 mb-4 border border-blue-100 animate-pulse">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h3 class="text-base font-extrabold text-slate-800">Pilih Lokasi Kampus & Fakultas</h3>
        <p class="text-sm text-slate-400 mt-1 max-w-sm">Silakan pilih lokasi kampus dan fakultas terlebih dahulu pada dropdown di atas untuk melihat daftar ruangan yang tersedia.</p>
        <p class="text-xs text-slate-400 mt-3 select-none">Atau, <button type="button" id="show-all-rooms-btn" class="text-blue-600 hover:text-blue-700 font-extrabold hover:underline cursor-pointer focus:outline-none transition-colors">Tampilkan Semua Ruangan</button> jika Anda kebingungan.</p>
    </div>

    <!-- Empty State (Hidden by default) -->
    <div id="empty-state" class="hidden col-span-full py-16 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h3 class="text-base font-extrabold text-slate-800">Ruangan Tidak Ditemukan</h3>
        <p class="text-sm text-slate-400 mt-1 max-w-xs">Coba sesuaikan kata kunci pencarian, gedung, atau status filter Anda.</p>
    </div>

</div>

<!-- Tailwind Safelist Comment for Dynamic PHP Classes
bg-emerald-900 bg-amber-900 bg-purple-900 bg-indigo-900
text-emerald-600 text-amber-600 text-purple-600 text-indigo-600
text-emerald-700 text-amber-700 text-purple-700 text-indigo-700
bg-emerald-950/40 hover:bg-emerald-950 text-emerald-200 border-emerald-700/50
bg-amber-950/40 hover:bg-amber-950 text-amber-200 border-amber-700/50
bg-purple-950/40 hover:bg-purple-950 text-purple-200 border-purple-700/50
bg-indigo-950/40 hover:bg-indigo-950 text-indigo-200 border-indigo-700/50
text-emerald-100/80 text-amber-100/80 text-purple-100/80 text-indigo-100/80
from-emerald-500/10 via-teal-500/5 to-cyan-500/10
from-amber-500/10 via-orange-500/5 to-yellow-500/10
from-purple-500/10 via-fuchsia-500/5 to-pink-500/10
from-indigo-500/10 via-blue-500/5 to-teal-500/10
bg-emerald-600 bg-amber-500 bg-purple-600 bg-indigo-600 text-slate-900
-->
@endsection


