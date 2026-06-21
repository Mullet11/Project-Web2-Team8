@extends('layouts.app')

@section('title', 'Pilih Jadwal - Smart Class Booking')

@section('content')
<!-- Header Banner Illustration (Matches brand color and ULM logo placeholder) -->
<div class="relative w-full h-64 bg-gradient-to-r from-blue-500/10 via-indigo-500/5 to-blue-600/10 -mx-4 sm:-mx-6 lg:-mx-8 w-[calc(100%+2rem)] sm:w-[calc(100%+3rem)] lg:w-[calc(100%+4rem)] rounded-none border-b border-blue-100/30 mb-8 flex items-center justify-center overflow-hidden select-none">
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

<!-- Content Area with Responsive Spacing -->
<div class="px-6 py-8 sm:px-10 sm:py-10 lg:px-16 lg:py-12">
    <!-- Main Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch mt-4">

    <!-- Left Column: Title, Back link, and Choose Time Grid -->
    <div class="lg:col-span-7 flex flex-col justify-between lg:h-full space-y-8 lg:space-y-0">

        <!-- Title inside left column (aligns top with right column) -->
        <div class="mb-6">
            <!-- Room Name (Matches website brand colors) -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                {{ $room['name'] }}
            </h1>
        </div>

        <!-- Date Selection (ULM Style premium card) -->
        <div class="bg-slate-50 border border-slate-200/60 p-5 rounded-2xl mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 select-none">
            <div class="space-y-0.5">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal Pemakaian</p>
                <p class="text-sm font-extrabold text-slate-700" id="formatted-date-label">{{ $formattedDate }}</p>
            </div>
            <div class="relative shrink-0">
                <input type="date" id="booking-date-selector" 
                    value="{{ $date }}" 
                    min="{{ date('Y-m-d') }}"
                    onchange="handleDateChange(this.value)"
                    class="px-4 py-2.5 bg-white border border-slate-200 focus:border-blue-600 rounded-xl text-xs sm:text-sm font-bold text-slate-700 focus:outline-none transition-colors cursor-pointer shadow-sm">
            </div>
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
                        <span class="w-3.5 h-3.5 rounded shrink-0" style="background-color: #EAB308;"></span>
                        <span>Diproses</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-[#A4C9C3] shrink-0"></span>
                        <span>Tersedia</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-[#CBD5E1] shrink-0"></span>
                        <span>Istirahat</span>
                    </div>
                </div>
            </div>
 
            <!-- Timeslots Grid (4 Columns, 3 Rows for 12 slots) -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($slots as $index => $slot)
                    @if($slot['status'] === 'terpakai')
                        <!-- Booked Slot (Pinkish/Red, Clickable Warning) -->
                        <button type="button"
                            class="time-slot-btn h-28 rounded-xl font-bold text-white flex flex-col items-center justify-center cursor-pointer select-none transition-all hover:scale-[1.02] active:scale-[0.98] p-2"
                            style="background-color: #DCA2A2; height: 112px;"
                            data-time="{{ $slot['time'] }}"
                            data-time-range="{{ $slot['time_range'] }}"
                            data-status="terpakai"
                            data-booking-nama="{{ $slot['booking']['nama'] ?? '' }}"
                            data-booking-nim="{{ $slot['booking']['nim'] ?? '' }}"
                            data-booking-prodi="{{ $slot['booking']['prodi_fakultas'] ?? '' }}"
                            data-booking-whatsapp="{{ $slot['booking']['whatsapp'] ?? '' }}"
                            data-booking-perihal="{{ $slot['booking']['perihal'] ?? '' }}"
                            data-booking-subject="{{ ($slot['booking']['perihal'] ?? '') === 'Perkuliahan' ? ($slot['booking']['matakuliah'] ?? '') : ($slot['booking']['nama_kegiatan'] ?? '') }}"
                            data-booking-dosen="{{ $slot['booking']['dosen'] ?? '' }}"
                            data-booking-status="terpakai"
                            onclick="handleBookedSlotClick(this)">
                            <span class="text-xs sm:text-sm md:text-base font-bold">{{ $slot['time_range'] }}</span>
                            <span class="text-[10px] uppercase font-black opacity-80 mt-1">Detail</span>
                        </button>
                    @elseif($slot['status'] === 'diproses')
                        <!-- Processing Slot (Yellow, Clickable Warning) -->
                        <button type="button"
                            class="time-slot-btn h-28 rounded-xl font-bold text-white flex flex-col items-center justify-center cursor-pointer select-none transition-all hover:scale-[1.02] active:scale-[0.98] p-2"
                            style="background-color: #EAB308; height: 112px;"
                            data-time="{{ $slot['time'] }}"
                            data-time-range="{{ $slot['time_range'] }}"
                            data-status="diproses"
                            data-booking-nama="{{ $slot['booking']['nama'] ?? '' }}"
                            data-booking-nim="{{ $slot['booking']['nim'] ?? '' }}"
                            data-booking-prodi="{{ $slot['booking']['prodi_fakultas'] ?? '' }}"
                            data-booking-whatsapp="{{ $slot['booking']['whatsapp'] ?? '' }}"
                            data-booking-perihal="{{ $slot['booking']['perihal'] ?? '' }}"
                            data-booking-subject="{{ ($slot['booking']['perihal'] ?? '') === 'Perkuliahan' ? ($slot['booking']['matakuliah'] ?? '') : ($slot['booking']['nama_kegiatan'] ?? '') }}"
                            data-booking-dosen="{{ $slot['booking']['dosen'] ?? '' }}"
                            data-booking-status="diproses"
                            onclick="handleBookedSlotClick(this)">
                            <span class="text-xs sm:text-sm md:text-base font-bold">{{ $slot['time_range'] }}</span>
                            <span class="text-[10px] uppercase font-black opacity-80 mt-1">Detail</span>
                        </button>
                    @elseif($slot['status'] === 'istirahat')
                        <!-- Break Slot (Grey, Disabled) -->
                        <button type="button"
                            class="time-slot-btn h-28 rounded-xl font-bold text-slate-500 flex flex-col items-center justify-center cursor-not-allowed select-none transition-all p-2 border border-slate-200"
                            style="background-color: #E2E8F0; height: 112px;"
                            data-time="{{ $slot['time'] }}"
                            data-time-range="{{ $slot['time_range'] }}"
                            data-status="istirahat"
                            onclick="showWarning('break')">
                            <span class="text-xs sm:text-sm md:text-base font-bold">{{ $slot['time_range'] }}</span>
                            <span class="text-[10px] uppercase font-black opacity-80 mt-1">Istirahat</span>
                        </button>
                    @else
                        <!-- Available Slot (Greyish-Teal, Clickable) -->
                        <button type="button"
                            class="time-slot-btn slot-btn h-28 rounded-xl font-bold text-white flex flex-col items-center justify-center transition-all duration-150 cursor-pointer shadow-sm hover:scale-[1.03] active:scale-[0.98] p-2"
                            style="background-color: #A4C9C3; height: 112px;"
                            data-time="{{ $slot['time'] }}"
                            data-time-range="{{ $slot['time_range'] }}"
                            data-status="tersedia"
                            onclick="selectSlot(this)">
                            <span class="text-xs sm:text-sm md:text-base font-bold">{{ $slot['time_range'] }}</span>
                            <span class="text-[10px] uppercase font-black opacity-80 mt-1">Tersedia</span>
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
            <h3 class="text-xl font-bold text-slate-800 tracking-tight">Tata Cara Peminjaman</h3>
            <ol class="space-y-3 text-sm text-slate-600 font-medium leading-relaxed">
                <li class="flex items-start gap-2">
                    <span>1.</span>
                    <span>Pilih rentang slot waktu yang berstatus <strong>Tersedia</strong> pada grid.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>2.</span>
                    <span>Pastikan jadwal yang dipilih sudah sesuai dengan kebutuhan Anda.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>3.</span>
                    <span>Klik tombol <strong>Next</strong> untuk memicu form pengisian data booking.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>4.</span>
                    <span>Lengkapi data peminjaman pada form modal yang muncul.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span>5.</span>
                    <span>Klik <strong>Simpan Booking</strong> dan tunggu konfirmasi persetujuan dari BAAK.</span>
                </li>
            </ol>
        </div>

        <!-- Room Facilities -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-slate-800 tracking-tight">Fasilitas Ruangan</h3>
            @if(!empty($room['facilities']))
                @php
                    $facilitiesList = array_map('trim', explode(',', $room['facilities']));
                @endphp
                <ol class="space-y-3 text-sm text-slate-600 font-medium leading-relaxed">
                    @foreach($facilitiesList as $index => $facility)
                        <li class="flex items-start gap-2">
                            <span>{{ $index + 1 }}.</span>
                            <span>{{ $facility }}</span>
                        </li>
                    @endforeach
                </ol>
            @else
                <p class="text-sm text-slate-500 italic">Tidak ada fasilitas khusus yang terdaftar untuk ruangan ini.</p>
            @endif
        </div>
    </div>
</div>
</div>

<!-- Custom Warning Toast -->
<div id="warning-toast" class="fixed top-6 right-6 z-50 flex items-center gap-3 bg-white border border-slate-100 shadow-2xl rounded-2xl px-5 py-4 -translate-y-20 opacity-0 pointer-events-none transition-all duration-300 max-w-sm select-none">
    <div id="warning-toast-icon-bg" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-500 shrink-0 shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
    </div>
    <div class="space-y-0.5">
        <p id="warning-toast-title" class="text-xs font-black text-slate-600 uppercase tracking-wider">Peringatan</p>
        <p id="warning-toast-message" class="text-sm font-bold text-slate-500 leading-normal"></p>
    </div>
    <button type="button" onclick="closeWarningToast()" class="text-slate-400 hover:text-slate-600 transition-colors ml-2 cursor-pointer focus:outline-none shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

@push('modals')
    @include('booking.formaddBooking')
    @include('booking.detailBooking')
@endpush
@endsection

@section('scripts')
<script>
    let selectedStartBtn = null;
    let selectedEndBtn = null;
    let toastTimeout = null;

    function showWarning(status) {
        const toast = document.getElementById('warning-toast');
        const iconBg = document.getElementById('warning-toast-icon-bg');
        const titleText = document.getElementById('warning-toast-title');
        const messageText = document.getElementById('warning-toast-message');

        // Reset classes
        toast.className = "fixed top-6 right-6 z-50 flex items-center gap-3 bg-white border shadow-2xl rounded-2xl px-5 py-4 -translate-y-20 opacity-0 pointer-events-none transition-all duration-300 max-w-sm select-none";

        if (status === 'booked') {
            toast.classList.add('border-rose-100');
            iconBg.className = "w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 shrink-0 shadow-sm";
            titleText.className = "text-xs font-black text-rose-600 uppercase tracking-wider";
            titleText.textContent = "JADWAL DIBOOKING";
            messageText.textContent = "Maaf, jadwal ini baru saja dibooking pengguna lain!";
        } else if (status === 'processing') {
            toast.classList.add('border-amber-100');
            iconBg.className = "w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500 shrink-0 shadow-sm";
            titleText.className = "text-xs font-black text-amber-600 uppercase tracking-wider";
            titleText.textContent = "JADWAL DIPROSES";
            messageText.textContent = "Maaf, jadwal ini sedang dalam proses antrean review oleh admin BAAK!";
        } else if (status === 'break') {
            toast.classList.add('border-slate-100');
            iconBg.className = "w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-500 shrink-0 shadow-sm";
            titleText.className = "text-xs font-black text-slate-600 uppercase tracking-wider";
            titleText.textContent = "JAM ISTIRAHAT";
            messageText.textContent = "Waktu istirahat / ISHOMA tidak dapat dibooking!";
        }

        // Animate Entry
        toast.classList.remove('pointer-events-none', 'opacity-0', '-translate-y-20');
        toast.classList.add('opacity-100', 'translate-y-0');

        // Clear timeout
        if (toastTimeout) {
            clearTimeout(toastTimeout);
        }

        // Auto close after 4 seconds
        toastTimeout = setTimeout(() => {
            closeWarningToast();
        }, 4000);
    }

    function showWarningCustom(message) {
        const toast = document.getElementById('warning-toast');
        const iconBg = document.getElementById('warning-toast-icon-bg');
        const titleText = document.getElementById('warning-toast-title');
        const messageText = document.getElementById('warning-toast-message');

        // Reset classes
        toast.className = "fixed top-6 right-6 z-50 flex items-center gap-3 bg-white border shadow-2xl rounded-2xl px-5 py-4 -translate-y-20 opacity-0 pointer-events-none transition-all duration-300 max-w-sm select-none";

        toast.classList.add('border-rose-100');
        iconBg.className = "w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 shrink-0 shadow-sm";
        titleText.className = "text-xs font-black text-rose-600 uppercase tracking-wider";
        titleText.textContent = "PILIHAN TIDAK VALID";
        messageText.textContent = message;

        // Animate Entry
        toast.classList.remove('pointer-events-none', 'opacity-0', '-translate-y-20');
        toast.classList.add('opacity-100', 'translate-y-0');

        // Clear timeout
        if (toastTimeout) {
            clearTimeout(toastTimeout);
        }

        // Auto close after 4 seconds
        toastTimeout = setTimeout(() => {
            closeWarningToast();
        }, 4000);
    }

    function closeWarningToast() {
        const toast = document.getElementById('warning-toast');
        if (toast) {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', '-translate-y-20', 'pointer-events-none');
        }
    }

    function selectSlot(buttonElement) {
        const allButtons = Array.from(document.querySelectorAll('.time-slot-btn'));
        
        // If start is not selected, or both start and end are already selected (resetting)
        if (!selectedStartBtn || (selectedStartBtn && selectedEndBtn)) {
            // Reset all available buttons to default color
            resetSelectionColors(allButtons);
            
            selectedStartBtn = buttonElement;
            selectedEndBtn = null;
            
            // Highlight start button green
            selectedStartBtn.style.backgroundColor = '#00A854';
            
            updateNextButton();
        } else {
            // Start is selected, now selecting end
            const startIndex = allButtons.indexOf(selectedStartBtn);
            const endIndex = allButtons.indexOf(buttonElement);
            
            if (endIndex === startIndex) {
                // Clicking the start button again resets it
                resetSelectionColors(allButtons);
                selectedStartBtn = null;
                selectedEndBtn = null;
                updateNextButton();
                return;
            }
            
            if (endIndex < startIndex) {
                // If they click a slot before the start, set it as the new start
                resetSelectionColors(allButtons);
                selectedStartBtn = buttonElement;
                selectedEndBtn = null;
                selectedStartBtn.style.backgroundColor = '#00A854';
                updateNextButton();
                return;
            }
            
            // Check if any slot between start and end is unavailable
            let hasUnavailable = false;
            for (let i = startIndex; i <= endIndex; i++) {
                const status = allButtons[i].getAttribute('data-status');
                if (status === 'terpakai' || status === 'diproses' || status === 'istirahat') {
                    hasUnavailable = true;
                    break;
                }
            }
            
            if (hasUnavailable) {
                showWarningCustom("Pilihan range melewati slot yang sudah dibooking atau istirahat!");
                return;
            }
            
            // Highlight all slots in between
            selectedEndBtn = buttonElement;
            for (let i = startIndex; i <= endIndex; i++) {
                allButtons[i].style.backgroundColor = '#00A854';
            }
            
            updateNextButton();
        }
    }

    function resetSelectionColors(allButtons) {
        allButtons.forEach(btn => {
            const status = btn.getAttribute('data-status');
            if (status === 'tersedia') {
                btn.style.backgroundColor = '#A4C9C3';
            }
        });
    }

    function updateNextButton() {
        const nextBtn = document.getElementById('next-button');
        const selectedSlotInput = document.getElementById('selected-slot-input');
        
        if (!selectedStartBtn) {
            // Disabled state
            selectedSlotInput.value = '';
            selectedSlotInput.removeAttribute('data-end-time');
            selectedSlotInput.removeAttribute('data-limit-time');
            
            nextBtn.disabled = true;
            nextBtn.style.backgroundColor = '#ECEFF1';
            nextBtn.style.color = '#94A3B8'; // text-slate-400
            nextBtn.classList.add('cursor-not-allowed', 'text-slate-400');
            nextBtn.classList.remove('cursor-pointer', 'hover:bg-[#1D4ED8]', 'text-white');
            nextBtn.textContent = 'Next';
        } else {
            const startRange = selectedStartBtn.getAttribute('data-time-range').split(' - ');
            const startTime = startRange[0];
            let endTime = startRange[1];
            
            let countSlots = 1;
            
            const allButtons = Array.from(document.querySelectorAll('.time-slot-btn'));
            const startIndex = allButtons.indexOf(selectedStartBtn);
            
            if (selectedEndBtn) {
                const endRange = selectedEndBtn.getAttribute('data-time-range').split(' - ');
                endTime = endRange[1];
                
                const endIndex = allButtons.indexOf(selectedEndBtn);
                countSlots = (endIndex - startIndex) + 1;
            }
            
            // Calculate max allowed end time based on subsequent occupied/break slots after start slot
            let limitTime = '18:00'; // Default limit is end of day
            for (let i = startIndex + 1; i < allButtons.length; i++) {
                const btn = allButtons[i];
                const status = btn.getAttribute('data-status');
                if (status === 'terpakai' || status === 'diproses' || status === 'istirahat') {
                    const range = btn.getAttribute('data-time-range').split(' - ');
                    limitTime = range[0]; // Start time of next occupied/break slot
                    break;
                }
            }
            
            // Set values for form submit
            selectedSlotInput.value = startTime;
            selectedSlotInput.setAttribute('data-end-time', endTime);
            selectedSlotInput.setAttribute('data-limit-time', limitTime);
            
            // Enable button
            nextBtn.disabled = false;
            nextBtn.style.backgroundColor = '#2563EB'; // brand blue-600
            nextBtn.style.color = '#FFFFFF';
            nextBtn.classList.remove('cursor-not-allowed', 'text-slate-400');
            nextBtn.classList.add('cursor-pointer', 'hover:bg-[#1D4ED8]');
            
            nextBtn.textContent = `Next (${countSlots} SKS - ${startTime} s/d ${endTime})`;
        }
    }

    function handleNext() {
        const selectedTime = document.getElementById('selected-slot-input').value;
        if (!selectedTime) return;

        // Open the booking modal from formaddBooking sub-view
        openBookingModal(selectedTime);
    }

    function handleBookedSlotClick(btn) {
        const nama = btn.getAttribute('data-booking-nama');
        const status = btn.getAttribute('data-booking-status');
        
        if (!nama) {
            // Fallback to warning toast if no detail data
            showWarning(status === 'diproses' ? 'processing' : 'booked');
            return;
        }
        
        const details = {
            time: btn.getAttribute('data-time'),
            status: status,
            nama: nama,
            nim: btn.getAttribute('data-booking-nim'),
            prodi: btn.getAttribute('data-booking-prodi'),
            whatsapp: btn.getAttribute('data-booking-whatsapp'),
            perihal: btn.getAttribute('data-booking-perihal'),
            subject: btn.getAttribute('data-booking-subject'),
            dosen: btn.getAttribute('data-booking-dosen')
        };
        
        openBookingDetailModal(details);
    }

    @if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        // Find the slot time that was submitted previously
        const oldWaktuMulai = "{{ old('waktu_mulai') }}";
        if (oldWaktuMulai) {
            // Mock selection to ensure UI is consistent
            document.getElementById('selected-slot-input').value = oldWaktuMulai;
            openBookingModal(oldWaktuMulai);
        }
    });
    @endif

    function handleDateChange(newDate) {
        if (!newDate) return;
        window.location.href = '?date=' + newDate;
    }
</script>
@endsection
