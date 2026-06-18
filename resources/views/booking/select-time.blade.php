@extends('layouts.app')

@section('title', 'Pilih Jadwal - Smart Class Booking')

@section('content')
<!-- Header Banner Illustration (Matches brand color and ULM logo placeholder) -->
<div class="relative w-full h-64 bg-gradient-to-r from-blue-500/10 via-indigo-500/5 to-blue-600/10 -mt-20 lg:-mt-8 -mx-4 sm:-mx-6 lg:-mx-8 w-[calc(100%+2rem)] sm:w-[calc(100%+3rem)] lg:w-[calc(100%+4rem)] rounded-none border-b border-blue-100/30 mb-12 flex items-center justify-center overflow-hidden select-none">
    <!-- ULM Logo/Image Placeholder (matches user request) -->
    <div class="h-36 flex items-center justify-center p-4">
        <img src="{{ asset('images/profile/ULM PNG.png') }}" alt="ULM Logo Placeholder" class="h-full object-contain filter drop-shadow-md">
    </div>

    <!-- Blue back button overlay (matches mockup style, brand color) -->
    <a href="/dashboard" class="absolute top-6 left-6 w-11 h-11 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-105 cursor-pointer z-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
</div>

<!-- Content Area with Padding 36px horizontal and 48px vertical -->
<div style="padding: 48px 36px;">
    <!-- Main Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch mt-4">

    <!-- Left Column: Title, Back link, and Choose Time Grid -->
    <div class="lg:col-span-7 flex flex-col justify-between lg:h-full space-y-8 lg:space-y-0">

        <!-- Title inside left column (aligns top with right column) -->
        <div>
            <!-- Room Name (Matches website brand colors) -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                {{ $room['name'] }}
            </h1>
        </div>

        <!-- Legend and Section Title Row (matches mockup layout) -->
        <div>
            <div class="flex flex-row items-center justify-between gap-4 border-b border-slate-100 pb-3 mb-6">
                <h3 class="text-xl font-bold text-slate-800">Pilih Jam</h3>

                <!-- Custom Colors Legend (matches mockup colors) -->
                <div class="flex items-center gap-4 text-xs font-bold text-slate-500 select-none">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-[#00A854] shrink-0"></span>
                        <span>Dipilih</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-[#DCA2A2] shrink-0"></span>
                        <span>Dibooking</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-[#A4C9C3] shrink-0"></span>
                        <span>Tersedia</span>
                    </div>
                </div>
            </div>

            <!-- Timeslots Grid (4 Columns, 2 Rows - exactly matches mockup layout) -->
            <div class="grid grid-cols-4 gap-4">
                @foreach($slots as $index => $slot)
                    @if($slot['status'] === 'terpakai')
                        <!-- Booked Slot (Pinkish/Red, Disabled) -->
                        <button type="button" disabled 
                            class="h-28 rounded-xl font-bold text-sm text-white flex items-center justify-center cursor-not-allowed select-none transition-all"
                            style="background-color: #DCA2A2; height: 112px;">
                            08:00
                        </button>
                    @else
                        <!-- Available Slot (Greyish-Teal, Clickable) -->
                        <button type="button" 
                            class="slot-btn h-28 rounded-xl font-bold text-sm text-white flex items-center justify-center transition-all duration-150 cursor-pointer shadow-sm hover:scale-[1.03] active:scale-[0.98]"
                            style="background-color: #A4C9C3; height: 112px;"
                            data-time="{{ $slot['time'] }}"
                            onclick="selectSlot(this)">
                            08:00
                        </button>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Hidden input to store chosen slot time -->
        <input type="hidden" id="selected-slot-input" name="selected_slot" value="">

        <!-- Next Button (matches mockup yellow/orange rounded style) -->
        <div class="pt-6">
            <button type="button" id="next-button" disabled
                class="w-full py-4 text-slate-400 font-bold text-sm rounded-xl text-center tracking-wide transition-all select-none cursor-not-allowed"
                style="background-color: #ECEFF1;"
                onclick="handleNext()">
                Next
            </button>
        </div>
    </div>

    <!-- Right Column: Guidelines & Facilities (Matches mockup plain list style) -->
    <div class="lg:col-span-5 space-y-10 pl-0 lg:pl-6">

        <!-- Booking Guidelines -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-slate-800 tracking-tight">Fasilitas</h3>
            <ol class="space-y-3 text-sm text-slate-600 font-medium leading-relaxed">
                <li class="flex items-start gap-2">
                    <span>1.</span>
                    <span>Pilih ruangan yang ingin digunakan.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>2.</span>
                    <span>Pilih slot waktu yang berstatus Tersedia.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>3.</span>
                    <span>Pastikan jadwal yang dipilih sudah sesuai kebutuhan.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>4.</span>
                    <span>Klik tombol Booking untuk mengajukan pemesanan.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>5.</span>
                    <span>Tunggu konfirmasi hingga booking berhasil dan jadwal tercatat pada sistem.</span>
                </li>
            </ol>
        </div>

        <!-- Room Facilities -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-slate-800 tracking-tight">Fasilitas</h3>
            <ol class="space-y-3 text-sm text-slate-600 font-medium leading-relaxed">
                <li class="flex items-start gap-2">
                    <span>1.</span>
                    <span>Komputer praktikum.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>2.</span>
                    <span>Proyektor dan layar presentasi.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>3.</span>
                    <span>Akses internet/Wi-Fi.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>4.</span>
                    <span>AC dan pencahayaan yang memadai.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>5.</span>
                    <span>Whiteboard dan perlengkapan penunjang pembelajaran.</span>
                </li>
            </ol>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    let selectedSlotBtn = null;

    function selectSlot(buttonElement) {
        // Reset previous selected slot button
        if (selectedSlotBtn) {
            selectedSlotBtn.style.backgroundColor = '#A4C9C3';
        }

        // Set new selected slot button
        selectedSlotBtn = buttonElement;
        selectedSlotBtn.style.backgroundColor = '#00A854';

        // Store selected slot in hidden input
        const selectedTime = selectedSlotBtn.getAttribute('data-time');
        document.getElementById('selected-slot-input').value = selectedTime;

        // Enable Next button (brand color: Blue)
        const nextBtn = document.getElementById('next-button');
        nextBtn.disabled = false;
        nextBtn.style.backgroundColor = '#2563EB'; // brand blue-600
        nextBtn.style.color = '#FFFFFF';
        nextBtn.classList.remove('cursor-not-allowed', 'text-slate-400');
        nextBtn.classList.add('cursor-pointer', 'hover:bg-[#1D4ED8]');
    }

    function handleNext() {
        const selectedTime = document.getElementById('selected-slot-input').value;
        if (!selectedTime) return;

        // Temporary feedback for Step 1 focus
        alert(`Anda memilih slot waktu ${selectedTime}. Halaman form booking akan dibuka selanjutnya.`);
    }
</script>
@endsection
