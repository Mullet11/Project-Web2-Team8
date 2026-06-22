@extends('layouts.app')

@section('title', 'Admin Dashboard - Smart Class Booking')

@section('content')

<!-- Main Container -->
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 mb-10">
    <!-- Page Header -->
    <div class="mb-8 select-none">
        <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Persetujuan Booking</h1>
        <p class="text-sm text-slate-500 mt-1">Tinjau dan kelola seluruh pengajuan reservasi ruangan dari mahasiswa atau dosen secara berkala.</p>
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

    <!-- Table Card Container (Limited width, centered, padded top-header) -->
    <div class="w-full bg-white rounded-3xl border border-slate-100 shadow-sm">
        <!-- Card Header -->
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/20 select-none rounded-t-3xl">
            <div>
                <h3 class="text-base font-black text-slate-900 tracking-tight">Daftar Pengajuan Peminjaman</h3>

            </div>
        </div>

        <!-- Desktop Table View (Visible on desktop, hidden on mobile, allows dropdown overflow) -->
        <div class="hidden md:block md:overflow-visible w-full">
            <table class="w-full text-sm text-left text-slate-500 border-collapse">
                <thead class="text-[10px] text-slate-400 uppercase bg-slate-50/40 border-b border-slate-100 tracking-wider font-black select-none">
                    <tr>
                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Ruangan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Perihal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reservations as $res)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <!-- Peminjam -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <p class="font-extrabold text-slate-800 leading-none">{{ $res->nama }}</p>
                            <p class="text-xs font-semibold text-slate-400 mt-1 tracking-wider">{{ $res->nim }}</p>
                        </td>
                        <!-- Ruangan -->
                        <td class="px-6 py-5 whitespace-nowrap font-extrabold text-slate-700">
                            {{ $res->room->name ?? 'Unknown Room' }}
                        </td>
                        <!-- Tanggal -->
                        <td class="px-6 py-5 whitespace-nowrap font-extrabold text-slate-600">
                            {{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}
                        </td>
                        <!-- Waktu -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="inline-block px-2.5 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg border border-blue-100/30">
                                {{ \Carbon\Carbon::parse($res->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($res->waktu_selesai)->format('H:i') }}
                            </span>
                        </td>
                        <!-- Perihal -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="inline-block px-2.5 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-black rounded-md uppercase tracking-wider select-none">
                                {{ $res->perihal }}
                            </span>
                        </td>
                        <!-- Dropdown Action -->
                        <td class="px-6 py-5 text-center whitespace-nowrap">
                            <div class="relative inline-block text-left dropdown-container">
                                <button onclick="toggleDropdown(this)" type="button" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-all cursor-pointer select-none shadow-sm focus:outline-none">
                                    <span>Pilih</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 dropdown-icon transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div class="dropdown-menu absolute right-0 z-50 mt-2 w-36 bg-white border border-slate-100 rounded-2xl shadow-xl overflow-hidden py-1.5 origin-top-right hidden opacity-0 transition-all duration-150">
                                    <!-- Setujui Option -->
                                    <form action="/admin/approve/{{ $res->id }}" method="POST" class="block w-full">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2.5 w-full px-3.5 py-2 text-left text-xs font-bold text-emerald-600 hover:bg-emerald-50 transition-colors cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Setujui
                                        </button>
                                    </form>

                                    <div class="border-t border-slate-100 my-1"></div>

                                    <!-- Tolak Option -->
                                    <form action="/admin/reject/{{ $res->id }}" method="POST" class="block w-full">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2.5 w-full px-3.5 py-2 text-left text-xs font-bold text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center select-none">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-base font-extrabold text-slate-800">Semua Pengajuan Selesai</h3>
                            <p class="text-sm text-slate-400 mt-1 max-w-xs mx-auto">Tidak ada pengajuan peminjaman ruangan yang menunggu persetujuan Anda saat ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View (Visible on mobile, hidden on desktop, prevents horizontal table scrolling issues) -->
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse($reservations as $res)
            <div class="p-5 space-y-4 hover:bg-slate-50/30 transition-colors">
                <!-- Top Row: Peminjam & Status/Perihal -->
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <p class="font-extrabold text-slate-800 leading-tight text-base">{{ $res->nama }}</p>
                        <p class="text-xs font-semibold text-slate-400 tracking-wider">{{ $res->nim }}</p>
                    </div>
                    <span class="inline-block px-2.5 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-black rounded-md uppercase tracking-wider select-none">
                        {{ $res->perihal }}
                    </span>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Ruangan</p>
                        <p class="font-extrabold text-slate-700 mt-0.5">{{ $res->room->name ?? 'Unknown Room' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Tanggal</p>
                        <p class="font-extrabold text-slate-700 mt-0.5">{{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-slate-400 font-bold uppercase tracking-wider text-[9px]">Waktu</p>
                        <div class="mt-1">
                            <span class="inline-block px-2.5 py-1 bg-blue-50 text-blue-600 font-bold rounded-lg border border-blue-100/30">
                                {{ \Carbon\Carbon::parse($res->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($res->waktu_selesai)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Dropdown for Mobile -->
                <div class="flex justify-end pt-3 border-t border-slate-100">
                    <div class="relative inline-block text-left dropdown-container w-full sm:w-auto">
                        <button onclick="toggleDropdown(this)" type="button" class="inline-flex items-center justify-between gap-1.5 w-full sm:w-auto px-4 py-1.5 bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition-all cursor-pointer select-none shadow-sm focus:outline-none">
                            <span>Pilih</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 dropdown-icon transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu absolute right-0 z-50 mt-2 w-full sm:w-36 bg-white border border-slate-100 rounded-2xl shadow-xl overflow-hidden py-1.5 origin-top-right hidden opacity-0 transition-all duration-150">
                            <!-- Setujui Option -->
                            <form action="/admin/approve/{{ $res->id }}" method="POST" class="block w-full">
                                @csrf
                                <button type="submit" class="flex items-center gap-2.5 w-full px-3.5 py-2 text-left text-xs font-bold text-emerald-600 hover:bg-emerald-50 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Setujui
                                </button>
                            </form>

                            <div class="border-t border-slate-100 my-1"></div>

                            <!-- Tolak Option -->
                            <form action="/admin/reject/{{ $res->id }}" method="POST" class="block w-full">
                                @csrf
                                <button type="submit" class="flex items-center gap-2.5 w-full px-3.5 py-2 text-left text-xs font-bold text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center select-none">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100/80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-800">Semua Pengajuan Selesai</h3>
                <p class="text-sm text-slate-400 mt-1 max-w-xs mx-auto">Tidak ada pengajuan peminjaman ruangan yang menunggu persetujuan Anda saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleDropdown(button) {
        const container = button.closest('.dropdown-container');
        const menu = container.querySelector('.dropdown-menu');
        const icon = container.querySelector('.dropdown-icon');

        // Close all other open dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(m => {
            if (m !== menu) {
                m.classList.add('hidden', 'opacity-0');
                const parent = m.closest('.dropdown-container');
                if (parent) {
                    const btnIcon = parent.querySelector('.dropdown-icon');
                    if (btnIcon) btnIcon.classList.remove('rotate-180');
                }
            }
        });

        // Toggle current dropdown
        const isHidden = menu.classList.contains('hidden');
        if (isHidden) {
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('opacity-0');
            }, 10);
            icon.classList.add('rotate-180');
        } else {
            menu.classList.add('opacity-0');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 150);
            icon.classList.remove('rotate-180');
        }
    }

    // Close dropdown on click outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown-container')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('opacity-0');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 150);
                const parent = menu.closest('.dropdown-container');
                if (parent) {
                    const btnIcon = parent.querySelector('.dropdown-icon');
                    if (btnIcon) btnIcon.classList.remove('rotate-180');
                }
            });
        }
    });
</script>
@endsection
