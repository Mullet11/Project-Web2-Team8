@extends('layouts.app')

@section('title', 'Riwayat Booking - Smart Class Booking')

@section('content')

<!-- Filters Panel -->
<div class="bg-white p-6 rounded-[24px] border border-slate-100 mb-6 space-y-6">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
        <!-- Search bar -->
        <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" id="search-input" placeholder="Cari nama ruang..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-medium placeholder:text-slate-400">
        </div>

        <!-- Filter Buttons (Horizontal Tabs) -->
        <div class="flex gap-1.5 p-1 bg-slate-50 rounded-xl overflow-x-auto w-full md:w-auto">
            <button data-status="all" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap bg-white text-slate-800 shadow-sm">
                Semua
            </button>
            <button data-status="disetujui" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850">
                Disetujui
            </button>
            <button data-status="selesai" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850">
                Selesai
            </button>
            <button data-status="dibatalkan" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850">
                Dibatalkan
            </button>
        </div>
    </div>
</div>

<!-- History Cards Grid (Matching Dashboard card design and mockup exactly) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="history-grid">

    <!-- Card 1: AULA UTAMA (Disetujui) -->
    <div class="history-card bg-white rounded-[24px] border border-slate-100 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group h-[380px]" data-status="disetujui" data-search="aula utama">
        <!-- Top Half: Premium Flat Vector Illustration (SVG) -->
        <div class="h-44 w-full bg-slate-50 flex items-center justify-center relative overflow-hidden shrink-0 border-b border-slate-100/50 rounded-t-[24px]">
            <svg viewBox="0 0 200 120" class="w-full h-full max-h-36 object-contain" xmlns="http://www.w3.org/2000/svg">
                <!-- Desk -->
                <rect x="20" y="90" width="160" height="6" rx="3" fill="#e2e8f0" />
                <!-- Presentation Screen -->
                <rect x="55" y="20" width="90" height="55" rx="4" fill="#cbd5e1" />
                <rect x="59" y="24" width="82" height="47" rx="2" fill="#3b82f6" />
                <!-- Speaker Stand -->
                <rect x="96" y="75" width="8" height="15" fill="#94a3b8" />
                <polygon points="85,90 100,75 115,90" fill="#64748b" />
                <!-- Illustration detail: Chat & Calendar -->
                <rect x="25" y="35" width="22" height="16" rx="3" fill="#38bdf8" />
                <path d="M30 43 h12 M30 47 h8" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" />
                <!-- Floating Graph inside Screen -->
                <path d="M65 60 l15-15 l10,10 l25-25" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                <circle cx="115" cy="30" r="3" fill="#facc15" />
            </svg>
        </div>
        <!-- Bottom Half: Details Section (Theme: Blue for Approved) -->
        <div class="p-6 text-white bg-blue-600 rounded-b-[24px] flex flex-col justify-between flex-grow">
            <!-- Info & Status Badge (Identical to mockup layout) -->
            <div class="flex justify-between items-center gap-4">
                <div class="overflow-hidden">
                    <h4 class="text-xl font-bold tracking-tight truncate">AULA UTAMA</h4>
                    <p class="text-xs text-blue-100/90 font-medium truncate mt-0.5">Gedung A &bull; 60 Kursi</p>
                </div>
                <span class="px-3.5 py-1.5 bg-white text-blue-600 text-xs font-bold rounded-xl shrink-0 select-none">
                    Disetujui
                </span>
            </div>

            <!-- Booking Time (Spacious & Clean) -->
            <p class="text-xs text-blue-100/90 font-semibold my-2">
                Senin, 22 Juni &bull; 13:00 - 16:00 WIB
            </p>

            <!-- Action Button (Identical to mockup button) -->
            <button class="w-full py-3 bg-white hover:bg-slate-50 text-blue-600 text-sm font-bold rounded-xl text-center transition-all duration-200 cursor-pointer">
                Detail
            </button>
        </div>
    </div>

    <!-- Card 2: Ruang LK-201 (Selesai) -->
    <div class="history-card bg-white rounded-[24px] border border-slate-100 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group h-[380px]" data-status="selesai" data-search="ruang lk-201">
        <!-- Top Half: Premium Flat Vector Illustration (SVG) -->
        <div class="h-44 w-full bg-slate-50 flex items-center justify-center relative overflow-hidden shrink-0 border-b border-slate-100/50 rounded-t-[24px]">
            <svg viewBox="0 0 200 120" class="w-full h-full max-h-36 object-contain" xmlns="http://www.w3.org/2000/svg">
                <!-- Desk -->
                <rect x="25" y="90" width="150" height="6" rx="3" fill="#e2e8f0" />
                <!-- Laptop -->
                <rect x="65" y="45" width="70" height="42" rx="4" fill="#64748b" />
                <rect x="69" y="49" width="62" height="34" rx="2" fill="#0d9488" />
                <rect x="60" y="86" width="80" height="4" rx="2" fill="#475569" />
                <!-- Mail Icon -->
                <rect x="30" y="30" width="24" height="16" rx="2" fill="#06b6d4" />
                <polygon points="30,32 42,40 54,32" fill="#ffffff" opacity="0.9" />
                <!-- Chart on screen -->
                <rect x="80" y="55" width="10" height="20" fill="#ffffff" opacity="0.8" />
                <rect x="95" y="60" width="10" height="15" fill="#ffffff" opacity="0.8" />
                <rect x="110" y="65" width="10" height="10" fill="#ffffff" opacity="0.8" />
            </svg>
        </div>
        <!-- Bottom Half: Details Section (Theme: Teal for Completed) -->
        <div class="p-6 text-white bg-brand-primary rounded-b-[24px] flex flex-col justify-between flex-grow">
            <!-- Info & Status Badge (Identical to mockup layout) -->
            <div class="flex justify-between items-center gap-4">
                <div class="overflow-hidden">
                    <h4 class="text-xl font-bold tracking-tight truncate">Ruang LK-201</h4>
                    <p class="text-xs text-teal-100/90 font-medium truncate mt-0.5">Gedung B &bull; 40 Kursi</p>
                </div>
                <span class="px-3.5 py-1.5 bg-white text-emerald-600 text-xs font-bold rounded-xl shrink-0 select-none">
                    Selesai
                </span>
            </div>

            <!-- Booking Time -->
            <p class="text-xs text-teal-100/90 font-semibold my-2">
                Jumat, 12 Juni &bull; 08:00 - 10:00 WIB
            </p>

            <!-- Action Button -->
            <button class="w-full py-3 bg-white hover:bg-slate-50 text-brand-primary text-sm font-bold rounded-xl text-center transition-all duration-200 cursor-pointer">
                Detail
            </button>
        </div>
    </div>

    <!-- Card 3: Ruang Seminar A-202 (Dibatalkan) -->
    <div class="history-card bg-white rounded-[24px] border border-slate-100 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group h-[380px]" data-status="dibatalkan" data-search="ruang seminar a-202">
        <!-- Top Half: Premium Flat Vector Illustration (SVG) -->
        <div class="h-44 w-full bg-slate-50 flex items-center justify-center relative overflow-hidden shrink-0 border-b border-slate-100/50 rounded-t-[24px]">
            <svg viewBox="0 0 200 120" class="w-full h-full max-h-36 object-contain" xmlns="http://www.w3.org/2000/svg">
                <!-- Desk -->
                <rect x="20" y="90" width="160" height="6" rx="3" fill="#e2e8f0" />
                <!-- Calendar Board -->
                <rect x="70" y="30" width="60" height="50" rx="6" fill="#cbd5e1" />
                <rect x="70" y="30" width="60" height="12" fill="#f43f5e" rx="3" />
                <!-- Calendar Dots -->
                <circle cx="80" cy="52" r="3" fill="#94a3b8" />
                <circle cx="95" cy="52" r="3" fill="#94a3b8" />
                <circle cx="110" cy="52" r="3" fill="#94a3b8" />
                <circle cx="80" cy="67" r="3" fill="#94a3b8" />
                <circle cx="95" cy="67" r="3" fill="#f43f5e" /> <!-- Highlight canceled day -->
                <circle cx="110" cy="67" r="3" fill="#94a3b8" />
                <!-- Cross symbol / Cancel badge overlay -->
                <circle cx="140" cy="45" r="16" fill="#ef4444" opacity="0.9" />
                <path d="M133 38 l14 14 M147 38 l-14 14" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
            </svg>
        </div>
        <!-- Bottom Half: Details Section (Theme: Rose for Canceled) -->
        <div class="p-6 text-white bg-rose-600 rounded-b-[24px] flex flex-col justify-between flex-grow">
            <!-- Info & Status Badge (Identical to mockup layout) -->
            <div class="flex justify-between items-center gap-4">
                <div class="overflow-hidden">
                    <h4 class="text-xl font-bold tracking-tight truncate">Ruang Seminar A-202</h4>
                    <p class="text-xs text-rose-100/90 font-medium truncate mt-0.5">Gedung A &bull; 40 Kursi</p>
                </div>
                <span class="px-3.5 py-1.5 bg-white text-rose-600 text-xs font-bold rounded-xl shrink-0 select-none">
                    Dibatalkan
                </span>
            </div>

            <!-- Booking Time -->
            <p class="text-xs text-rose-100/90 font-semibold my-2">
                Rabu, 10 Juni &bull; 09:00 - 11:00 WIB
            </p>

            <!-- Action Button -->
            <button class="w-full py-3 bg-white hover:bg-slate-50 text-rose-600 text-sm font-bold rounded-xl text-center transition-all duration-200 cursor-pointer">
                Detail
            </button>
        </div>
    </div>

    <!-- Empty State -->
    <div id="empty-state" class="hidden col-span-full py-16 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h3 class="text-base font-extrabold text-slate-800">Tidak Ada Riwayat</h3>
        <p class="text-sm text-slate-400 mt-1 max-w-xs">Tidak menemukan riwayat booking yang sesuai dengan pencarian atau filter Anda.</p>
    </div>

</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const tabs = document.querySelectorAll('.status-tab');
        const cards = document.querySelectorAll('.history-card');
        const emptyState = document.getElementById('empty-state');

        let currentStatus = 'all';
        let searchQuery = '';

        // Handle Status Tabs
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active classes from all tabs
                tabs.forEach(t => {
                    t.classList.remove('bg-white', 'text-slate-800', 'shadow-sm');
                    t.classList.add('text-slate-500');
                });

                // Add active classes to clicked tab
                this.classList.add('bg-white', 'text-slate-800', 'shadow-sm');
                this.classList.remove('text-slate-500');

                currentStatus = this.getAttribute('data-status');
                filterCards();
            });
        });

        // Handle Search Input
        searchInput.addEventListener('input', function() {
            searchQuery = this.value.toLowerCase().trim();
            filterCards();
        });

        // Filter and Search Logic
        function filterCards() {
            let visibleCount = 0;

            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                const cardSearchText = card.getAttribute('data-search').toLowerCase();

                const matchesStatus = (currentStatus === 'all' || cardStatus === currentStatus);
                const matchesSearch = (searchQuery === '' || cardSearchText.includes(searchQuery));

                if (matchesStatus && matchesSearch) {
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
                }
            });

            // Toggle empty state
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    });
</script>
@endsection
