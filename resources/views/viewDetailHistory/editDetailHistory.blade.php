@extends('layouts.app')

@section('title', 'Edit Booking - Smart Class Booking')

@section('content')
<!-- Page Header -->
<div class="mb-8 select-none flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="/history/detail/{{ $booking['id'] }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-500 hover:text-slate-700 transition-colors shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Edit Booking</h1>
            <p class="text-sm text-slate-500 mt-1">Nomor Booking: {{ $booking['no_booking'] }}</p>
        </div>
    </div>
    <!-- Dynamic Status Badge -->
    <div class="flex items-center shrink-0">
        <span class="px-4 py-2 bg-slate-100 border border-slate-200 text-slate-600 text-xs font-black rounded-xl select-none shrink-0 tracking-wider uppercase">
            {{ $booking['status'] }}
        </span>
    </div>
</div>

<!-- Main Split Container (50% Room Visual, 50% Form) -->
<div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 mb-10">
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-2">
        
        <!-- LEFT COLUMN: Only Room Image (Visible only on lg screen sizes) -->
        <div class="hidden lg:block relative bg-slate-50 border-r border-slate-100 select-none min-h-[500px]">
            <img src="{{ $booking['image_url'] }}" alt="{{ $booking['room_name'] }}" class="absolute inset-0 w-full h-full object-cover">
        </div>

        <!-- RIGHT COLUMN: Booking Form Container -->
        <div class="flex flex-col bg-white">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/40 select-none">
                <div>
                    <h3 class="text-xl font-black text-slate-950 tracking-tight">Form Edit Data</h3>
                    <p class="text-xs font-semibold text-slate-400 mt-0.5">Ubah data pengajuan peminjaman ruangan Anda</p>
                </div>
            </div>

            <!-- Form Body -->
            <form id="edit-booking-form" method="POST" action="/history/edit/{{ $booking['id'] }}" class="p-8 space-y-5">
                @csrf
                <!-- Nama Lengkap -->
                <div class="space-y-1.5">
                    <label for="booking-nama" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" id="booking-nama" name="nama" required value="{{ $booking['nama'] }}" placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                </div>

                <!-- NIM -->
                <div class="space-y-1.5">
                    <label for="booking-nim" class="text-xs font-bold text-slate-500 uppercase tracking-wider">NIM</label>
                    <input type="text" id="booking-nim" name="nim" required value="{{ $booking['nim'] }}" placeholder="Masukkan NIM Anda"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                </div>

                <!-- Prodi/Fakultas -->
                <div class="space-y-1.5">
                    <label for="booking-prodi" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Prodi / Fakultas</label>
                    <input type="text" id="booking-prodi" name="prodi_fakultas" required value="{{ $booking['prodi_fakultas'] }}" placeholder="Teknologi Informasi / Teknik"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                </div>

                <!-- WhatsApp -->
                <div class="space-y-1.5">
                    <label for="booking-whatsapp" class="text-xs font-bold text-slate-500 uppercase tracking-wider">No. WhatsApp Aktif</label>
                    <input type="tel" id="booking-whatsapp" name="whatsapp" required value="{{ $booking['whatsapp'] }}" placeholder="Contoh: 08123456789"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                </div>

                <!-- Perihal Peminjaman -->
                <div class="space-y-1.5">
                    <label for="booking-perihal" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Perihal Peminjaman</label>
                    <select id="booking-perihal" name="perihal" onchange="togglePerihalFields()"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-850 font-bold cursor-pointer">
                        <option value="Perkuliahan" {{ $booking['perihal'] === 'Perkuliahan' ? 'selected' : '' }}>Perkuliahan / Praktikum</option>
                        <option value="Kegiatan Kampus" {{ $booking['perihal'] === 'Kegiatan Kampus' ? 'selected' : '' }}>Kegiatan Kampus</option>
                    </select>
                </div>

                <!-- Dosen & Mata Kuliah (Only shown for Perkuliahan, stacked vertically) -->
                <div id="fields-perkuliahan" class="space-y-5 transition-all duration-200">
                    <div class="space-y-1.5">
                        <label for="booking-dosen" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Dosen Pengampu</label>
                        <div class="relative">
                            <select id="booking-dosen" name="dosen"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium appearance-none cursor-pointer pr-10">
                                <option value="" disabled>Pilih Dosen Pengampu</option>
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
                            <select id="booking-matakuliah" name="matakuliah"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium appearance-none cursor-pointer pr-10">
                                <option value="" disabled>Pilih Mata Kuliah</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-450">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nama Kegiatan (Only shown for Kegiatan Kampus, full width) -->
                <div id="fields-kegiatan" class="space-y-1.5 hidden transition-all duration-200">
                    <label for="booking-kegiatan" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Kegiatan</label>
                    <input type="text" id="booking-kegiatan" name="nama_kegiatan" value="{{ $booking['nama_kegiatan'] ?? '' }}" placeholder="Nama kegiatan organisasi / kampus"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">
                </div>

                <!-- Tanggal Peminjaman (Full Width) -->
                <div class="space-y-1.5">
                    <label for="booking-tanggal" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Peminjaman</label>
                    <input type="date" id="booking-tanggal" name="tanggal" required value="{{ $booking['tanggal_raw'] }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium">
                </div>

                <!-- Waktu Mulai & Waktu Selesai (2 columns for neatness) -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="booking-waktu-mulai" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu Mulai</label>
                        <input type="time" id="booking-waktu-mulai" name="waktu_mulai" required readonly value="{{ $booking['waktu_mulai'] }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium cursor-not-allowed text-slate-500">
                    </div>
                    <div class="space-y-1.5">
                        <label for="booking-waktu-selesai" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu Selesai</label>
                        <input type="time" id="booking-waktu-selesai" name="waktu_selesai" required value="{{ $booking['waktu_selesai'] }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-blue-600 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium">
                    </div>
                </div>

                <!-- Opsi Pembatalan -->
                <div class="pt-4 mt-6 border-t border-slate-100">
                    <label class="flex items-center gap-3 cursor-pointer select-none">
                        <input type="checkbox" name="cancel_booking" id="cancel_booking_cb" value="1" onchange="toggleCancelReason()" class="w-5 h-5 rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                        <span class="text-sm font-bold text-rose-600">Batalkan Pengajuan Peminjaman Ini</span>
                    </label>
                    <div id="cancel_reason_container" class="hidden mt-4 space-y-1.5">
                        <label for="alasan_batal" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alasan Batal</label>
                        <textarea id="alasan_batal" name="alasan_batal" rows="2" placeholder="Sebutkan alasan Anda membatalkan peminjaman (opsional)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-rose-500 focus:bg-white rounded-xl text-sm focus:outline-none transition-all text-slate-800 font-medium placeholder:text-slate-400/80">{{ $booking['alasan_batal'] }}</textarea>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="pt-6 border-t border-slate-100 flex gap-3 justify-end select-none">
                    <a href="/history/detail/{{ $booking['id'] }}"
                        class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold rounded-xl transition-colors cursor-pointer text-center flex items-center justify-center">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-600/15 hover:shadow-blue-600/25 transition-all cursor-pointer text-center flex items-center justify-center">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Dynamic Database-driven Lecturer & Course Lists
    const databaseSchedules = @json($schedulesList ?? []);
    const savedDosen = "{{ $booking['dosen'] ?? '' }}";
    const savedMatakuliah = "{{ $booking['matakuliah'] ?? '' }}";

    function updateDosenDanMatakuliah(useSavedValues = false) {
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

        // Get currently selected or fallback to saved value
        const currentDosen = useSavedValues ? savedDosen : dosenSelect.value;
        dosenSelect.innerHTML = '<option value="" disabled selected>Pilih Dosen Pengampu</option>';
        uniqueLecturers.forEach(lecturer => {
            const opt = document.createElement('option');
            opt.value = lecturer;
            opt.textContent = lecturer;
            dosenSelect.appendChild(opt);
        });
        if (uniqueLecturers.includes(currentDosen)) {
            dosenSelect.value = currentDosen;
        }

        const currentMatakuliah = useSavedValues ? savedMatakuliah : matakuliahSelect.value;
        matakuliahSelect.innerHTML = '<option value="" disabled selected>Pilih Mata Kuliah</option>';
        uniqueCourses.forEach(course => {
            const opt = document.createElement('option');
            opt.value = course;
            opt.textContent = course;
            matakuliahSelect.appendChild(opt);
        });
        if (uniqueCourses.includes(currentMatakuliah)) {
            matakuliahSelect.value = currentMatakuliah;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Run initial check for form fields visibility
        togglePerihalFields();

        // Listen for input changes in the prodi field to update dropdowns
        const prodiInput = document.getElementById('booking-prodi');
        if (prodiInput) {
            prodiInput.addEventListener('input', () => updateDosenDanMatakuliah(false));
            // Initialize dropdowns and select currently saved values
            updateDosenDanMatakuliah(true);
        }
    });

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

    function toggleCancelReason() {
        const isChecked = document.getElementById('cancel_booking_cb').checked;
        const container = document.getElementById('cancel_reason_container');
        if (isChecked) {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection
