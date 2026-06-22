@extends('layouts.app')

@section('title', 'Log Reservasi - Smart Class Booking')

@section('content')

<!-- Main Container -->
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 mb-10">
    <!-- Page Header -->
    <div class="mb-8 select-none">
        <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Log Reservasi</h1>
        <p class="text-sm text-slate-500 mt-1">Audit dan pantau riwayat lengkap seluruh reservasi ruangan oleh mahasiswa dan dosen.</p>
    </div>

    <!-- Search and Filters Panel -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-8 space-y-5 select-none">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end">
            <!-- Search bar -->
            <div class="md:col-span-6 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                    Cari Reservasi
                </label>
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" id="search-input" placeholder="Cari nama, NIM, no. booking, atau ruangan..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-700 font-semibold placeholder:text-slate-400 shadow-inner">
                </div>
            </div>

            <!-- Status Tabs -->
            <div class="md:col-span-6 space-y-2">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Status Booking
                </label>
                <div class="flex gap-1.5 p-1 bg-slate-50 border border-slate-200/50 rounded-xl overflow-x-auto w-full">
                    <button data-status="all" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap bg-white text-slate-800 shadow-sm cursor-pointer border-0">
                        Semua
                    </button>
                    <button data-status="menunggu" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer border-0 bg-transparent">
                        Menunggu
                    </button>
                    <button data-status="disetujui" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer border-0 bg-transparent">
                        Disetujui
                    </button>
                    <button data-status="selesai" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer border-0 bg-transparent">
                        Selesai
                    </button>
                    <button data-status="dibatalkan" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer border-0 bg-transparent">
                        Batal
                    </button>
                    <button data-status="ditolak" class="status-tab px-4 py-2 text-xs font-bold rounded-lg transition-all whitespace-nowrap text-slate-500 hover:text-slate-850 cursor-pointer border-0 bg-transparent">
                        Ditolak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden select-none">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="reservations-table">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="px-6 py-4.5">No. Booking</th>
                        <th class="px-6 py-4.5">Ruangan</th>
                        <th class="px-6 py-4.5">Peminjam</th>
                        <th class="px-6 py-4.5">Waktu Penggunaan</th>
                        <th class="px-6 py-4.5">Perihal / Kegiatan</th>
                        <th class="px-6 py-4.5">Status</th>
                        <th class="px-6 py-4.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reservations as $res)
                    @php
                        $statusClass = match(strtolower($res->status)) {
                            'menunggu' => 'bg-amber-50 border-amber-200 text-amber-600',
                            'disetujui' => 'bg-blue-50 border-blue-200 text-blue-600',
                            'selesai' => 'bg-emerald-50 border-emerald-200 text-emerald-600',
                            'dibatalkan' => 'bg-rose-50 border-rose-200 text-rose-600',
                            'ditolak' => 'bg-slate-50 border-slate-200 text-slate-500',
                            default => 'bg-slate-50 border-slate-200 text-slate-500'
                        };
                    @endphp
                    <tr class="reservation-row hover:bg-slate-50/40 transition-colors" 
                        data-status="{{ strtolower($res->status) }}" 
                        data-search="{{ strtolower($res->no_booking . ' ' . ($res->room->name ?? '') . ' ' . $res->nama . ' ' . $res->nim) }}">
                        <td class="px-6 py-4 text-xs font-bold text-slate-700 tracking-wider">
                            <span class="px-2.5 py-1 bg-slate-100 rounded-lg border border-slate-200/50">
                                {{ $res->no_booking }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-0.5">
                                <p class="text-sm font-extrabold text-slate-800">{{ $res->room->name ?? 'N/A' }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">{{ $res->room->campus ?? 'N/A' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-0.5">
                                <p class="text-sm font-extrabold text-slate-800">{{ $res->nama }}</p>
                                <p class="text-xs font-semibold text-slate-400">NIM: {{ $res->nim }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs font-semibold text-slate-600">
                            <div class="space-y-0.5">
                                <p class="font-extrabold text-slate-700">{{ \Carbon\Carbon::parse($res->tanggal)->locale('id')->translatedFormat('d F Y') }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">{{ substr($res->waktu_mulai, 0, 5) }} s/d {{ substr($res->waktu_selesai, 0, 5) }} WITA</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-0.5 max-w-[200px] truncate">
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $res->perihal }}</p>
                                <p class="text-sm font-extrabold text-slate-800 truncate" title="{{ $res->nama_kegiatan ?? $res->matakuliah ?? '-' }}">
                                    {{ $res->nama_kegiatan ?? $res->matakuliah ?? '-' }}
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 border rounded-xl text-xs font-bold uppercase tracking-wider {{ $statusClass }}">
                                {{ $res->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="relative inline-block" id="res-dropdown-wrap-{{ $res->id }}">
                                <!-- Tombol Pilih -->
                                <button
                                    type="button"
                                    onclick="toggleResDropdown({{ $res->id }})"
                                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-all cursor-pointer select-none shadow-sm"
                                >
                                    <span>Pilih</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform duration-200" id="res-chevron-{{ $res->id }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div
                                    id="res-dropdown-{{ $res->id }}"
                                    class="absolute right-0 z-50 mt-2 w-36 bg-white border border-slate-100 rounded-2xl shadow-xl opacity-0 invisible scale-95 transition-all duration-200 origin-top-right"
                                >
                                    <div class="p-1.5">
                                        <a href="/history/detail/{{ $res->id }}" class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs font-bold text-blue-700 hover:bg-blue-50 transition-colors cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800">Belum Ada Reservasi</h3>
                            <p class="text-sm text-slate-400 mt-1 max-w-xs mx-auto">Seluruh riwayat pengajuan peminjaman ruangan akan tercatat di halaman ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Empty Filter State (Shown via JS when search yields 0 results) -->
        <div id="empty-filter-state" class="hidden py-16 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-base font-extrabold text-slate-800">Reservasi Tidak Ditemukan</h3>
            <p class="text-sm text-slate-400 mt-1 max-w-xs">Coba sesuaikan kata kunci pencarian atau status filter Anda.</p>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // --- Reservation Log Dropdown Logic ---
    let activeResDropdownId = null;

    function toggleResDropdown(id) {
        if (activeResDropdownId !== null && activeResDropdownId !== id) {
            closeResDropdown(activeResDropdownId);
        }
        const menu = document.getElementById('res-dropdown-' + id);
        const chevron = document.getElementById('res-chevron-' + id);
        const isOpen = !menu.classList.contains('invisible');

        if (isOpen) {
            closeResDropdown(id);
        } else {
            menu.classList.remove('opacity-0', 'invisible', 'scale-95');
            menu.classList.add('opacity-100', 'visible', 'scale-100');
            chevron.classList.add('rotate-180');
            activeResDropdownId = id;
        }
    }

    function closeResDropdown(id) {
        const menu = document.getElementById('res-dropdown-' + id);
        const chevron = document.getElementById('res-chevron-' + id);
        if (menu) {
            menu.classList.add('opacity-0', 'invisible', 'scale-95');
            menu.classList.remove('opacity-100', 'visible', 'scale-100');
        }
        if (chevron) chevron.classList.remove('rotate-180');
        if (activeResDropdownId === id) activeResDropdownId = null;
    }

    document.addEventListener('click', function(e) {
        if (activeResDropdownId !== null) {
            const wrap = document.getElementById('res-dropdown-wrap-' + activeResDropdownId);
            if (wrap && !wrap.contains(e.target)) {
                closeResDropdown(activeResDropdownId);
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const tabs = document.querySelectorAll('.status-tab');
        const rows = document.querySelectorAll('.reservation-row');
        const emptyState = document.getElementById('empty-filter-state');
        const table = document.getElementById('reservations-table');

        let currentStatus = 'all';
        let searchQuery = '';

        // Handle Status Tabs
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Reset classes for tabs
                tabs.forEach(t => {
                    t.classList.remove('bg-white', 'text-slate-800', 'shadow-sm');
                    t.classList.add('text-slate-500', 'bg-transparent');
                });

                // Set active classes for selected tab
                this.classList.add('bg-white', 'text-slate-800', 'shadow-sm');
                this.classList.remove('text-slate-500', 'bg-transparent');

                currentStatus = this.getAttribute('data-status');
                filterRows();
            });
        });

        // Handle Search Input
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                searchQuery = this.value.toLowerCase().trim();
                filterRows();
            });
        }

        // Filter Function
        function filterRows() {
            let visibleCount = 0;

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowSearchText = row.getAttribute('data-search');

                const matchesStatus = (currentStatus === 'all' || rowStatus === currentStatus);
                const matchesSearch = (searchQuery === '' || rowSearchText.includes(searchQuery));

                if (matchesStatus && matchesSearch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Toggle empty state and headers visibility
            const hasInitialReservations = {{ count($reservations) }} > 0;
            if (hasInitialReservations) {
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                    table.classList.add('hidden');
                } else {
                    emptyState.classList.add('hidden');
                    table.classList.remove('hidden');
                }
            }
        }
    });
</script>
@endsection
