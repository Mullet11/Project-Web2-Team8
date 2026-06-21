@extends('layouts.app')

@section('title', $room['name'] . ' - Jadwal Ruangan')

@section('content')
<!-- Header Banner / Back Button (Matches brand style) -->
<div class="relative w-full h-32 bg-gradient-to-r from-blue-500/10 via-indigo-500/5 to-blue-600/10 -mt-20 lg:-mt-8 -mx-4 sm:-mx-6 lg:-mx-8 w-[calc(100%+2rem)] sm:w-[calc(100%+3rem)] lg:w-[calc(100%+4rem)] rounded-none border-b border-blue-100/30 mb-8 flex items-center justify-center overflow-hidden select-none">
    <div class="w-full max-w-[1440px] px-4 sm:px-6 lg:px-10 flex items-center justify-between">
        <div class="flex items-center gap-5">
            <!-- Back button (brand blue-600) -->
            <a href="/dashboard" class="w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-105 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="space-y-0.5">
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $room['name'] }}</h1>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">{{ $room['campus'] }}</p>
            </div>
        </div>
        <!-- Occupied status badge (Terpakai) -->
        <span class="px-4 py-2 bg-rose-50 border border-rose-200 text-rose-600 text-xs font-black rounded-xl select-none shrink-0 tracking-wider uppercase animate-pulse">
            Terpakai
        </span>
    </div>
</div>

<!-- Main Split Screen Layout (50% Image, 50% Schedule Timeline) -->
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">

    <!-- LEFT COLUMN: Room Visual Image Placeholder -->
    <div class="bg-white border border-slate-200/60 rounded-[32px] p-6 flex items-center justify-center select-none shadow-sm min-h-[350px] lg:min-h-[500px] overflow-hidden">
        <img src="{{ asset('images/profile/ULM PNG.png') }}" alt="ULM Logo Placeholder" class="max-h-[90%] max-w-[90%] object-contain filter drop-shadow-md">
    </div>

    <!-- RIGHT COLUMN: Agenda & Schedule Timeline -->
    <div class="space-y-6 flex flex-col justify-between">
        <!-- Title & Spec Tag Row -->
        <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
            <h3 class="text-xl font-black text-slate-900 tracking-tight select-none">Agenda Hari Ini</h3>
            <div class="flex gap-2 text-[10px] font-bold text-slate-500 uppercase select-none">
                <span class="px-2.5 py-1 bg-slate-100 border border-slate-200/60 rounded-lg">
                    {{ $room['type'] }}
                </span>
                <span class="px-2.5 py-1 bg-slate-100 border border-slate-200/60 rounded-lg">
                    {{ $room['capacity'] }} Kursi
                </span>
            </div>
        </div>

        <!-- Vertical Timeline List -->
        <div class="relative pl-6 border-l border-slate-200/80 space-y-8 flex-grow py-2">
            @foreach($schedules as $schedule)
                <!-- Timeline Item -->
                <div class="relative">
                    
                    <!-- Pulsing status dot on timeline -->
                    @if($schedule['status'] === 'sedang_berlangsung')
                        <span class="absolute -left-[31px] top-1.5 flex h-4.5 w-4.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-4.5 w-4.5 bg-emerald-500 border border-white"></span>
                        </span>
                    @elseif($schedule['status'] === 'selesai')
                        <span class="absolute -left-[31px] top-1.5 h-4.5 w-4.5 rounded-full bg-slate-300 border border-white"></span>
                    @else
                        <span class="absolute -left-[31px] top-1.5 h-4.5 w-4.5 rounded-full bg-blue-500 border border-white"></span>
                    @endif

                    <!-- Time slot label -->
                    <div class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1.5 select-none">
                        {{ $schedule['time'] }} WIB
                    </div>

                    <!-- Details Card -->
                    <div class="bg-white rounded-2xl border border-slate-200/60 p-5 hover:-translate-y-0.5 hover:shadow-md hover:border-slate-300/65 transition-all duration-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        
                        <div class="space-y-2 flex-grow">
                            <!-- Badges -->
                            <div class="flex items-center gap-2 select-none">
                                <!-- Type badge (Perkuliahan vs Kegiatan) -->
                                @if($schedule['type'] === 'Perkuliahan')
                                    <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[10px] font-black rounded-md uppercase tracking-wider">
                                        Perkuliahan
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-purple-50 text-purple-600 text-[10px] font-black rounded-md uppercase tracking-wider">
                                        Kegiatan Kampus
                                    </span>
                                @endif

                                <!-- Status label -->
                                @if($schedule['status'] === 'sedang_berlangsung')
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-md uppercase tracking-wider">
                                        Sedang Berlangsung
                                    </span>
                                @elseif($schedule['status'] === 'selesai')
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-400 text-[10px] font-bold rounded-md uppercase tracking-wider">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-blue-500 text-white text-[10px] font-black rounded-md uppercase tracking-wider">
                                        Akan Datang
                                    </span>
                                @endif
                            </div>

                            <!-- Subject / Activity Title -->
                            <h4 class="text-base font-black text-slate-900 leading-snug">
                                {{ $schedule['subject'] ?? $schedule['activity'] }}
                            </h4>

                            <!-- Subdetails -->
                            <div class="text-xs font-semibold text-slate-500 space-y-0.5 leading-relaxed">
                                @if($schedule['type'] === 'Perkuliahan')
                                    <p><span class="text-slate-400">Dosen:</span> {{ $schedule['lecturer'] }}</p>
                                    <p><span class="text-slate-400">Kelas:</span> {{ $schedule['class'] }}</p>
                                @else
                                    <p><span class="text-slate-400">PIC:</span> {{ $schedule['pic'] }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Action/WhatsApp Contact Button -->
                        @if($schedule['status'] !== 'selesai')
                            <a href="https://wa.me/{{ $schedule['whatsapp'] }}" target="_blank" 
                                class="px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 hover:text-emerald-700 text-xs font-black rounded-xl flex items-center gap-1.5 transition-colors cursor-pointer select-none border border-emerald-100 shrink-0">
                                <!-- WhatsApp icon -->
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.665.989 3.3 1.472 5.358 1.473 5.467 0 9.914-4.444 9.918-9.909.002-2.646-1.02-5.136-2.889-7.001C17.16 1.85 14.678.826 12.01.826c-5.468 0-9.915 4.445-9.919 9.91-.001 2.115.56 4.18 1.624 5.995l-1.064 3.887 3.996-1.048zm11.238-6.197c-.272-.136-1.61-.794-1.859-.885-.25-.091-.432-.136-.613.136-.182.273-.705.885-.863 1.067-.159.182-.318.205-.59.069-.272-.136-1.15-.424-2.19-1.353-.809-.721-1.355-1.613-1.514-1.886-.159-.273-.017-.42.119-.556.122-.122.272-.318.409-.477.136-.159.182-.272.272-.454.091-.181.045-.341-.023-.477-.068-.136-.613-1.477-.84-2.023-.222-.534-.488-.46-.613-.466-.12-.005-.272-.006-.432-.006-.159 0-.417.06-.634.295-.218.236-.832.813-.832 1.984 0 1.171.852 2.302.97 2.461.119.159 1.674 2.557 4.057 3.586.567.245 1.01.391 1.356.501.57.181 1.088.156 1.498.094.457-.069 1.61-.659 1.838-1.295.227-.636.227-1.182.159-1.295-.068-.113-.25-.205-.522-.341z" />
                                </svg>
                                <span>Hubungi PIC</span>
                            </a>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
