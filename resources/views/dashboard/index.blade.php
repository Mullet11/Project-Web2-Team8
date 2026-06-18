@extends('layouts.app')

@section('title', 'Dashboard - Smart Class Booking')

@section('content')

<!-- Search and Filters Panel -->
<div class="bg-white p-6 rounded-[24px] border border-slate-100 mb-8 space-y-6">
    <!-- Top Row: Search and Status Select -->
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <!-- Search bar -->
        <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" id="search-input" placeholder="Cari nama atau nomor ruangan..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-medium placeholder:text-slate-400">
        </div>

        <!-- Dropdown Status Filter (Premium Custom Select) -->
        <div class="relative w-full md:w-56 shrink-0" id="status-dropdown">
            <button type="button" id="status-dropdown-button" class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm font-semibold text-slate-600 transition-all cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-600/5" aria-haspopup="listbox" aria-expanded="false">
                <span class="flex items-center gap-2" id="status-selected-label">
                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                    <span>Semua Status</span>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition-transform duration-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Menu Options -->
            <div id="status-dropdown-menu" class="absolute right-0 z-50 w-full mt-2 origin-top-right bg-white border border-slate-200 rounded-2xl opacity-0 invisible scale-95 transition-all duration-200 pointer-events-none" role="listbox">
                <div class="p-1.5 space-y-0.5">
                    <div class="status-option flex items-center gap-2 px-3.5 py-2.5 text-sm font-semibold text-slate-600 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors" role="option" data-value="all" data-color="bg-slate-400">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        Semua Status
                    </div>
                    <div class="status-option flex items-center gap-2 px-3.5 py-2.5 text-sm font-semibold text-teal-600 rounded-xl cursor-pointer hover:bg-teal-50/50 transition-colors" role="option" data-value="tersedia" data-color="bg-emerald-500">
                        <span class="relative flex h-2 w-2 shrink-0">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Tersedia
                    </div>
                    <div class="status-option flex items-center gap-2 px-3.5 py-2.5 text-sm font-semibold text-rose-600 rounded-xl cursor-pointer hover:bg-rose-50/50 transition-colors" role="option" data-value="terpakai" data-color="bg-rose-500">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        Terpakai
                    </div>
                </div>
            </div>
            <input type="hidden" name="status" id="status-filter-input" value="all">
        </div>
    </div>

    <!-- Divider Line -->
    <div class="border-t border-slate-100"></div>

    <!-- Bottom Row: Horizontal Building Tabs -->
    <div class="flex flex-col gap-2">

        <div class="flex gap-2 overflow-x-auto pb-2 -mx-2 px-2 scrollbar-none" id="building-tabs-container">
            <button data-building="all" class="building-tab px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl transition-all whitespace-nowrap">
                Semua Gedung
            </button>
            <button data-building="A" class="building-tab px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-100/50">
                Gedung A (Dekanat)
            </button>
            <button data-building="B" class="building-tab px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-100/50">
                Gedung B (Lab Komputer)
            </button>
            <button data-building="C" class="building-tab px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-100/50">
                Gedung C (Sains & Tek)
            </button>
            <button data-building="D" class="building-tab px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs font-bold rounded-xl transition-all whitespace-nowrap border border-slate-100/50">
                Gedung D (Sastra & Seni)
            </button>
        </div>
    </div>
</div>

<!-- Rooms Grid Section (Mockup Style) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="rooms-grid">

    @foreach ($rooms as $room)
    <!-- Dynamic Room Card -->
    <div class="room-card bg-white rounded-[24px] border border-slate-100 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group h-[380px]" data-status="{{ $room['status'] === 'available' ? 'tersedia' : ($room['status'] === 'occupied' ? 'terpakai' : 'inactive') }}" data-building="{{ substr($room['building'], -1) }}" data-name="{{ strtolower($room['name']) }}">
        <!-- Top Half: Image Placeholder -->
        <div class="h-44 w-full bg-gradient-to-br from-blue-500/10 via-indigo-500/5 to-teal-500/10 rounded-t-[24px] flex items-center justify-center relative overflow-hidden shrink-0 border-b border-slate-100/50">
            <span class="text-[10px] font-bold text-slate-400/80 uppercase tracking-widest">[ Image Placeholder ]</span>
        </div>
        <!-- Bottom Half: Details Section -->
        <div class="p-6 text-white {{ $room['status'] === 'available' ? 'bg-brand-primary' : 'bg-slate-800' }} rounded-b-[24px] flex flex-col justify-between flex-grow">
            <!-- Info & Status Badge -->
            <div class="flex justify-between items-start gap-4">
                <div class="overflow-hidden">
                    <h4 class="text-xl font-extrabold tracking-tight truncate">{{ $room['name'] }}</h4>
                    <p class="text-xs text-teal-100/80 font-semibold truncate mt-1">{{ $room['building'] }} &bull; {{ $room['capacity'] }} Kursi</p>
                </div>
                <span class="px-3 py-1 bg-white {{ $room['status'] === 'available' ? 'text-emerald-600' : 'text-rose-600' }} text-xs font-bold rounded-xl shrink-0 select-none">
                    {{ $room['status'] === 'available' ? 'Tersedia' : ($room['status'] === 'occupied' ? 'Terpakai' : 'Nonaktif') }}
                </span>
            </div>
            <!-- Booking Button -->
            <a href="/rooms/{{ $room['id'] }}" class="w-full py-3 {{ $room['status'] === 'available' ? 'bg-white hover:bg-slate-50 text-brand-primary' : 'bg-slate-900/50 hover:bg-slate-900 text-slate-300 hover:text-white border border-slate-700' }} text-sm font-bold rounded-xl text-center transition-all duration-200">
                {{ $room['status'] === 'available' ? 'Booking' : 'Lihat Jadwal' }}
            </a>
        </div>
    </div>
    @endforeach

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
@endsection
