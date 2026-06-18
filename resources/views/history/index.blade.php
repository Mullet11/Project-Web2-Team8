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
            <button data-status="menunggu" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850">
                Menunggu
            </button>
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
                    <p class="text-xs {{ $card['theme']['text_bottom'] }} font-medium truncate mt-0.5">{{ $card['building'] }} &bull; {{ $card['capacity'] }} Kursi</p>
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
