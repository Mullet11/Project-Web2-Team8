@extends('layouts.app')

@section('title', 'Riwayat Booking - Smart Class Booking')

@section('content')

<!-- Page Header -->
<div class="mb-8 select-none">
    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Riwayat Booking</h1>
    <p class="text-sm text-slate-500 mt-1">Pantau status pengajuan peminjaman ruangan Anda beserta detail informasi reservasinya.</p>
</div>

<!-- Filters Panel -->
<div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-6 space-y-5 select-none">
    <!-- Panel Header -->
    <div class="flex items-center justify-between pb-3 border-b border-slate-100/80">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider">Filter & Pencarian Riwayat</h4>
        </div>
        <!-- Reset Button (Visible only when filtering is active) -->
        <button type="button" id="btn-reset-filter" class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 hover:bg-slate-100 text-[10px] text-slate-500 hover:text-slate-700 font-extrabold rounded-lg border border-slate-200/60 transition-all duration-200 opacity-0 pointer-events-none cursor-pointer select-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5" />
            </svg>
            <span>Reset Filter</span>
        </button>
    </div>

    <!-- Row 1: Search, Status tabs -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
        <!-- Search bar -->
        <div class="md:col-span-6 space-y-2">
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
                <input type="text" id="search-input" placeholder="Cari nama ruang..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-semibold placeholder:text-slate-400 shadow-inner">
            </div>
        </div>

        <!-- Filter Buttons (Horizontal Tabs) -->
        <div class="md:col-span-6 space-y-2">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Status Booking
            </label>
            <div class="flex gap-1.5 p-1 bg-slate-50 border border-slate-200/50 rounded-xl overflow-x-auto w-full">
                <button data-status="all" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap bg-white text-slate-800 shadow-sm cursor-pointer">
                    Semua
                </button>
                <button data-status="disetujui" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer">
                    Disetujui
                </button>
                <button data-status="selesai" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer">
                    Selesai
                </button>
                <button data-status="dibatalkan" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer">
                    Dibatalkan
                </button>
                <button data-status="menunggu" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer">
                    Menunggu
                </button>
            </div>
        </div>
    </div>
</div>

<!-- History Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="history-grid">

    @foreach($historyCards as $card)
    <div class="history-card bg-white rounded-[24px] border border-slate-100 hover:-translate-y-1.5 transition-all duration-300 flex flex-col group h-[380px]" data-status="{{ $card['status'] }}" data-search="{{ strtolower($card['room_name']) }}">
        <!-- Top Half -->
        <div class="h-44 w-full bg-slate-50 flex items-center justify-center relative overflow-hidden shrink-0 border-b border-slate-100/50 rounded-t-[24px]">
            {!! $card['theme']['svg'] !!}
        </div>
        <!-- Bottom Half: Details Section -->
        <div class="p-6 text-white {{ $card['theme']['bg_bottom'] }} rounded-b-[24px] flex flex-col justify-between flex-grow">
            <!-- Info & Status Badge -->
            <div class="flex justify-between items-center gap-4">
                <div class="overflow-hidden">
                    <h4 class="text-xl font-bold tracking-tight truncate">{{ $card['room_name'] }}</h4>
                    <p class="text-xs {{ $card['theme']['text_bottom'] }} font-medium truncate mt-0.5">{{ $card['campus'] }} &bull; {{ $card['capacity'] }} Kursi</p>
                </div>
                <span class="px-3.5 py-1.5 bg-white {{ $card['theme']['badge_text'] }} text-xs font-bold rounded-xl shrink-0 select-none">
                    {{ $card['status_label'] }}
                </span>
            </div>

            <!-- Booking Time -->
            <p class="text-xs {{ $card['theme']['text_bottom'] }} font-semibold my-2">
                {{ $card['tanggal'] }} &bull; {{ $card['waktu'] }}
            </p>

            <!-- Action Button -->
            <a href="/history/detail/{{ $card['id'] }}" class="w-full py-3 {{ $card['theme']['btn_class'] }} text-sm font-bold rounded-xl text-center transition-all duration-200 cursor-pointer block">
                Detail
            </a>
        </div>
    </div>
    @endforeach

    <!-- Empty State -->
    <div id="empty-state" class="{{ count($historyCards) > 0 ? 'hidden' : '' }} col-span-full py-16 flex flex-col items-center justify-center text-center">
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

        // Handle Reset Filter Button Click
        const resetBtn = document.getElementById('btn-reset-filter');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                searchInput.value = '';
                searchQuery = '';
                
                // Programmatically click the 'all' tab
                const allTab = document.querySelector('.status-tab[data-status="all"]');
                if (allTab) {
                    allTab.click();
                } else {
                    filterCards();
                }
            });
        }

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

            // Show/hide Reset button dynamically
            const isFiltering = searchQuery !== '' || currentStatus !== 'all';
            if (resetBtn) {
                if (isFiltering) {
                    resetBtn.classList.remove('opacity-0', 'pointer-events-none');
                } else {
                    resetBtn.classList.add('opacity-0', 'pointer-events-none');
                }
            }
        }
    });
</script>
@endsection
