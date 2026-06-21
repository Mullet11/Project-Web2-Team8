@extends('layouts.app')

@section('title', 'Dashboard - Smart Class Booking')

@section('content')

<!-- Search and Filters Panel -->
<div class="bg-white p-6 rounded-[24px] border border-slate-100 mb-8 space-y-6">
    <!-- Title -->
    <div class="border-b border-slate-100 pb-5">
        <div>
            <h3 class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight leading-none">Cari & Booking Ruangan</h3>
            <p class="text-xs text-slate-400 font-bold mt-2 select-none">Temukan kelas, laboratorium, dan aula Universitas Lambung Mangkurat dengan mudah</p>
        </div>
    </div>

    <!-- Top Row: Search, Campus, Faculty, and Status Select -->
    <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
        <!-- Search bar -->
        <div class="relative w-full lg:flex-grow">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" id="search-input" placeholder="Cari nama atau nomor ruangan..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-medium placeholder:text-slate-400">
        </div>

        <div class="flex flex-col md:flex-row gap-4 w-full lg:w-auto shrink-0">
            <!-- Dropdown Campus Filter (Premium Custom Select) -->
            <div class="relative w-full md:w-64 shrink-0" id="campus-dropdown">
                <button type="button" id="campus-dropdown-button" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm font-semibold text-slate-600 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5" aria-haspopup="listbox" aria-expanded="false">
                    <span class="flex items-center gap-2 whitespace-nowrap" id="campus-selected-label">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        <span>Pilih Lokasi Kampus</span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

            <!-- Dropdown Faculty Filter (Premium Custom Select) -->
            <div class="relative w-full md:w-56 shrink-0" id="faculty-dropdown">
                <button type="button" id="faculty-dropdown-button" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm font-semibold text-slate-600 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5" aria-haspopup="listbox" aria-expanded="false">
                    <span class="flex items-center gap-2 whitespace-nowrap" id="faculty-selected-label">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        <span>Pilih Fakultas</span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                        <div class="faculty-option flex items-center gap-2 px-3.5 py-2.5 text-xs font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors whitespace-nowrap" role="option" data-value="teknik">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Teknik (FT)
                        </div>
                    </div>
                </div>
                <input type="hidden" name="faculty" id="faculty-filter-input" value="">
            </div>

            <!-- Dropdown Status Filter (Premium Custom Select) -->
            <div class="relative w-full md:w-48 shrink-0" id="status-dropdown">
                <button type="button" id="status-dropdown-button" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm font-semibold text-slate-600 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5" aria-haspopup="listbox" aria-expanded="false">
                    <span class="flex items-center gap-2 whitespace-nowrap" id="status-selected-label">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        <span>Semua Status</span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
    <div class="room-card bg-white rounded-[24px] border border-slate-100 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group h-[380px]" data-status="{{ $room->data_status }}" data-building="{{ $room->data_building }}" data-type="{{ $room->data_type }}" data-name="{{ $room->data_name }}" data-campus="{{ $room->campus }}" data-faculty="{{ $room->data_faculty }}" style="display: none;">
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
            <!-- Action Button -->
            <a href="{{ $room->button_url }}" class="w-full py-3 {{ $room->button_class }} text-sm font-bold rounded-xl text-center transition-all duration-200">
                {{ $room->button_text }}
            </a>
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


