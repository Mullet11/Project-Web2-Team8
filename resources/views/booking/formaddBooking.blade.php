<!-- Booking Form Modal Overlay (Dark background backdrop) -->
<div id="booking-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 opacity-0 pointer-events-none transition-opacity duration-300 select-none">
    <!-- Backdrop overlay to make background dark and blurred -->
    <div id="booking-modal-backdrop" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeBookingModal()"></div>

    <!-- Modal Window Container -->
    <div id="booking-modal-content" class="bg-white rounded-[32px] border border-slate-100 shadow-2xl w-full max-w-[95%] sm:max-w-xl md:max-w-2xl lg:max-w-3xl max-h-[90vh] overflow-y-auto relative z-10 transform scale-95 opacity-0 transition-all duration-300 flex flex-col mx-auto">

        <!-- Success State Container (Covers entire modal over grid) -->
        <div id="booking-success-state" class="hidden flex-col items-center justify-center text-center p-8 md:p-16 space-y-6 bg-white flex-grow h-full select-none absolute inset-0 z-20">
            <!-- Pulsing success checkmark icon -->
            <div class="relative flex items-center justify-center">
                <div class="absolute w-28 h-28 rounded-full bg-emerald-100 animate-ping opacity-75"></div>
                <div class="relative w-24 h-24 rounded-full bg-emerald-500 flex items-center justify-center shadow-lg shadow-emerald-500/20 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <div class="space-y-3 max-w-md">
                <h3 class="text-3xl font-extrabold text-slate-950">Booking Berhasil!</h3>
                <p class="text-sm text-slate-500 font-semibold leading-relaxed">
                    Pengajuan peminjaman ruangan Anda berhasil dikirim. Anda akan diarahkan ke halaman Riwayat Booking...
                </p>
            </div>

            <!-- Loading Spinner Indicator -->
            <div class="flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-wider">
                <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>

        <!-- Main Form Container -->
        <div id="booking-form-container" class="flex flex-col w-full bg-white">
            <!-- Header -->
            <div class="px-6 sm:px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/40 select-none sticky top-0 z-10">
                <div>
                    <h3 class="text-2xl font-black text-slate-950 tracking-tight">Form Booking</h3>
                    <p class="text-xs font-semibold text-slate-400 mt-0.5">Lengkapi data untuk mengajukan peminjaman</p>
                </div>
                <!-- Close button -->
                <button type="button" onclick="closeBookingModal()" class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition-colors cursor-pointer focus:outline-none shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form Body -->
            <form id="booking-form" method="POST" action="/booking/{{ $id }}" class="p-6 sm:p-8 space-y-6" onsubmit="submitBooking(event)">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                    @if($errors->any())
                        <div id="booking-error-alert" class="sm:col-span-2 mb-4 bg-rose-100 border border-rose-400 text-rose-700 px-4 py-3 rounded-xl relative">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Nama Lengkap -->
                    <div class="space-y-1.5">
                        <label for="booking-nama" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" id="booking-nama" name="nama" required placeholder="Masukkan nama lengkap"
                            value="{{ old('nama', auth()->user()->name ?? '') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                    </div>

                    <!-- NIM -->
                    <div class="space-y-1.5">
                        <label for="booking-nim" class="text-xs font-bold text-slate-500 uppercase tracking-wider">NIM</label>
                        <input type="text" id="booking-nim" name="nim" required placeholder="Masukkan NIM Anda"
                            value="{{ old('nim', auth()->user()->identity_number ?? '') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                    </div>

                    <!-- Prodi/Fakultas -->
                    <div class="space-y-1.5">
                        <label for="booking-prodi" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Prodi / Fakultas</label>
                        <input type="text" id="booking-prodi" name="prodi_fakultas" required placeholder="Teknologi Informasi / Teknik"
                            value="{{ old('prodi_fakultas', auth()->user()->study_program ? auth()->user()->study_program . ' / ' . auth()->user()->faculty : '') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                    </div>

                    <!-- WhatsApp -->
                    <div class="space-y-1.5">
                        <label for="booking-whatsapp" class="text-xs font-bold text-slate-500 uppercase tracking-wider">No. WhatsApp Aktif</label>
                        <input type="tel" id="booking-whatsapp" name="whatsapp" required placeholder="Contoh: 08123456789"
                            value="{{ old('whatsapp', auth()->user()->whatsapp ?? '') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                    </div>

                    <!-- Perihal Peminjaman -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="booking-perihal" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Perihal Peminjaman</label>
                        <select id="booking-perihal" name="perihal" onchange="togglePerihalFields()"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-850 font-bold cursor-pointer">
                            <option value="Perkuliahan">Perkuliahan / Praktikum</option>
                            <option value="Kegiatan Kampus">Kegiatan Kampus</option>
                        </select>
                    </div>
                </div>

                <!-- Dosen & Mata Kuliah (Perkuliahan) -->
                <div id="fields-perkuliahan" class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6 transition-all duration-200">
                    <div class="space-y-1.5">
                        <label for="booking-dosen" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Dosen Pengampu</label>
                        <div class="relative">
                            <select id="booking-dosen" name="dosen" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium appearance-none cursor-pointer pr-10">
                                <option value="" disabled selected>Pilih Dosen Pengampu</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-450">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label for="booking-matakuliah" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Mata Kuliah</label>
                        <div class="relative">
                            <select id="booking-matakuliah" name="matakuliah" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium appearance-none cursor-pointer pr-10">
                                <option value="" disabled selected>Pilih Mata Kuliah</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-450">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama Kegiatan (Kegiatan Kampus) -->
                <div id="fields-kegiatan" class="space-y-1.5 hidden transition-all duration-200">
                    <label for="booking-kegiatan" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Kegiatan</label>
                    <input type="text" id="booking-kegiatan" name="nama_kegiatan" placeholder="Nama kegiatan organisasi / kampus"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                    <!-- Tanggal Peminjaman -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="booking-tanggal" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Peminjaman</label>
                        <input type="date" id="booking-tanggal" name="tanggal" required readonly
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-850 font-bold cursor-not-allowed text-slate-500">
                    </div>

                    <!-- Waktu Mulai & Waktu Selesai -->
                    <div class="space-y-1.5">
                        <label for="booking-waktu-mulai" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu Mulai</label>
                        <input type="time" id="booking-waktu-mulai" name="waktu_mulai" required readonly
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium cursor-not-allowed text-slate-500">
                    </div>
                    <div class="space-y-1.5">
                        <label for="booking-waktu-selesai" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu Selesai</label>
                        <input type="time" id="booking-waktu-selesai" name="waktu_selesai" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium">
                    </div>
                </div>

                    <!-- Footer Buttons -->
                    <div class="pt-4 border-t border-slate-100 flex gap-3 justify-end bg-white select-none">
                        <button type="button" onclick="closeBookingModal()"
                            class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold rounded-xl transition-colors cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-600/15 hover:shadow-blue-600/25 transition-all cursor-pointer">
                            Simpan Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Open Booking Modal Function
    function openBookingModal(selectedTime) {
        const modal = document.getElementById('booking-modal');
        const backdrop = document.getElementById('booking-modal-backdrop');
        const content = document.getElementById('booking-modal-content');

        // Ensure success state is hidden and form is visible on open
        document.getElementById('booking-success-state').classList.add('hidden');
        document.getElementById('booking-form-container').classList.remove('hidden');

        // Reset form inputs (except defaults)
        document.getElementById('booking-form').reset();

        // Pre-fill Date input with selected date from selector
        const selectedDate = document.getElementById('booking-date-selector').value;
        document.getElementById('booking-tanggal').value = selectedDate;

        // Set Waktu Mulai (Start Time) to selected slot time
        document.getElementById('booking-waktu-mulai').value = selectedTime;

        // Get pre-selected end time from range selection
        const selectedSlotInput = document.getElementById('selected-slot-input');
        const preselectedEndTime = selectedSlotInput ? selectedSlotInput.getAttribute('data-end-time') : null;

        if (preselectedEndTime) {
            document.getElementById('booking-waktu-selesai').value = preselectedEndTime;
        } else if (selectedTime) {
            const timeParts = selectedTime.split(':');
            let hours = parseInt(timeParts[0], 10);
            let minutes = parseInt(timeParts[1], 10);

            // Add 1 hour and 40 minutes (2 SKS)
            minutes += 40;
            if (minutes >= 60) {
                minutes -= 60;
                hours += 1;
            }
            hours += 1;

            // Format hours and minutes back to HH:MM
            const endHours = String(hours).padStart(2, '0');
            const endMinutes = String(minutes).padStart(2, '0');
            document.getElementById('booking-waktu-selesai').value = `${endHours}:${endMinutes}`;
        }

        // Apply max limit constraints based on next occupied slot
        const limitTime = document.getElementById('selected-slot-input').getAttribute('data-limit-time') || '18:00';
        const endTimeInput = document.getElementById('booking-waktu-selesai');
        endTimeInput.max = limitTime;

        const label = document.querySelector('label[for="booking-waktu-selesai"]');
        if (label) {
            label.innerHTML = `Waktu Selesai <span class="text-rose-500 font-black text-[10px] uppercase tracking-wider">(Batas Maks: ${limitTime})</span>`;
        }

        // Trigger Perihal Fields visibility check
        togglePerihalFields();

        // Update dynamic lecturers and courses list
        updateDosenDanMatakuliah();

        // Animate modal entry
        modal.classList.remove('pointer-events-none', 'opacity-0');
        modal.classList.add('opacity-100');
        backdrop.classList.replace('opacity-0', 'opacity-100');

        setTimeout(() => {
            content.classList.replace('scale-95', 'scale-100');
            content.classList.replace('opacity-0', 'opacity-100');
        }, 50);
    }

    // Close Booking Modal Function
    function closeBookingModal() {
        const modal = document.getElementById('booking-modal');
        const backdrop = document.getElementById('booking-modal-backdrop');
        const content = document.getElementById('booking-modal-content');

        const errorAlert = document.getElementById('booking-error-alert');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }

        // Animate modal exit
        content.classList.replace('scale-100', 'scale-95');
        content.classList.replace('opacity-100', 'opacity-0');
        backdrop.classList.replace('opacity-100', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('pointer-events-none', 'opacity-0');
            modal.classList.remove('opacity-100');
        }, 300);
    }

    // Toggle Perihal Fields Visibility and Required status
    function togglePerihalFields() {
        const perihal = document.getElementById('booking-perihal').value;
        const fieldsPerkuliahan = document.getElementById('fields-perkuliahan');
        const fieldsKegiatan = document.getElementById('fields-kegiatan');

        const inputDosen = document.getElementById('booking-dosen');
        const inputMatakuliah = document.getElementById('booking-matakuliah');
        const inputKegiatan = document.getElementById('booking-kegiatan');

        if (perihal === 'Kegiatan Kampus') {
            // Hide perkuliahan fields, show kegiatan fields
            fieldsPerkuliahan.classList.add('hidden');
            fieldsKegiatan.classList.remove('hidden');

            // Toggle required status
            inputDosen.removeAttribute('required');
            inputMatakuliah.removeAttribute('required');
            inputKegiatan.setAttribute('required', 'required');
        } else {
            // Show perkuliahan fields, hide kegiatan fields
            fieldsPerkuliahan.classList.remove('hidden');
            fieldsKegiatan.classList.add('hidden');

            // Toggle required status
            inputDosen.setAttribute('required', 'required');
            inputMatakuliah.setAttribute('required', 'required');
            inputKegiatan.removeAttribute('required');
        }
    }

    // Handle Form Submit
    function submitBooking(event) {
        const endTime = document.getElementById('booking-waktu-selesai').value;
        const limitTime = document.getElementById('selected-slot-input').getAttribute('data-limit-time') || '18:00';

        if (endTime > limitTime) {
            event.preventDefault();
            alert(`Waktu selesai tidak boleh melebihi batas pemakaian berikutnya (${limitTime} WIB)!`);
            return false;
        }

        document.getElementById('booking-form-container').classList.add('hidden');
        document.getElementById('booking-success-state').classList.replace('hidden', 'flex');
        
        // Let the form submit
        return true;
    }

    // Dynamic Database-driven Lecturer & Course Lists
    const databaseSchedules = @json($schedulesList ?? []);

    function updateDosenDanMatakuliah() {
        const prodiInput = document.getElementById('booking-prodi');
        if (!prodiInput) return;

        const val = prodiInput.value || '';
        const prodiName = val.split(' / ')[0].trim().toLowerCase();

        const dosenSelect = document.getElementById('booking-dosen');
        const matakuliahSelect = document.getElementById('booking-matakuliah');

        if (!dosenSelect || !matakuliahSelect) return;

        let filtered = [];
        if (prodiName) {
            filtered = databaseSchedules.filter(item => 
                item.prodi && item.prodi.toLowerCase() === prodiName
            );
        }

        const schedulesToUse = filtered.length > 0 ? filtered : databaseSchedules;

        const uniqueLecturers = [...new Set(schedulesToUse.map(item => item.lecturer_name).filter(name => name))].sort();
        const uniqueCourses = [...new Set(schedulesToUse.map(item => item.title).filter(title => title))].sort();

        const oldDosen = dosenSelect.value;
        dosenSelect.innerHTML = '<option value="" disabled selected>Pilih Dosen Pengampu</option>';
        uniqueLecturers.forEach(lecturer => {
            const opt = document.createElement('option');
            opt.value = lecturer;
            opt.textContent = lecturer;
            dosenSelect.appendChild(opt);
        });
        if (uniqueLecturers.includes(oldDosen)) {
            dosenSelect.value = oldDosen;
        }

        const oldMatakuliah = matakuliahSelect.value;
        matakuliahSelect.innerHTML = '<option value="" disabled selected>Pilih Mata Kuliah</option>';
        uniqueCourses.forEach(course => {
            const opt = document.createElement('option');
            opt.value = course;
            opt.textContent = course;
            matakuliahSelect.appendChild(opt);
        });
        if (uniqueCourses.includes(oldMatakuliah)) {
            matakuliahSelect.value = oldMatakuliah;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const prodiInput = document.getElementById('booking-prodi');
        if (prodiInput) {
            prodiInput.addEventListener('input', updateDosenDanMatakuliah);
            updateDosenDanMatakuliah();
        }
    });
</script>
