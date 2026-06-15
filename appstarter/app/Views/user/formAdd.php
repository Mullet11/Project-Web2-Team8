<!-- Overlay Modal Container -->
<div id="modalFormAdd" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <!-- Darkened Background Backdrop -->
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeFormAdd()"></div>
    


    <!-- Main White Overlay Card (Landscape / Rectangular shape) -->
    <div class="relative w-full max-w-[900px] bg-white rounded-[20px] shadow-2xl p-8 border border-slate-100 overflow-y-auto max-h-[90vh] animate-in fade-in zoom-in duration-200">
        
        <!-- Title -->
        <h3 class="text-2xl font-bold text-[#FFB800] text-center mb-6">Form Booking</h3>

        <!-- Form (Grid of 2 Columns) -->
        <form action="<?= base_url('booking/create') ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="id_ruangan" id="id_ruangan" value="<?= $room['id'] ?? '1' ?>">
            
            <!-- Left Column: Primary User details -->
            <div class="space-y-4">
                <!-- Kategori Peminjaman -->
                <div>
                    <label class="block text-slate-900 font-bold text-[14px] mb-2">Kategori Peminjaman</label>
                    <div class="relative">
                        <select id="kategori_peminjaman" name="kategori_peminjaman" onchange="handleKategoriChange(this.value)" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm appearance-none cursor-pointer">
                            <option value="kelas_pembelajaran" selected>Kelas Pembelajaran</option>
                            <option value="kelas_pengganti">Kelas Pengganti</option>
                            <option value="kegiatan_camp">Kegiatan Kampus</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="w-4 h-4 fill-current text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5H7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Nama Field -->
                <div>
                    <label class="block text-slate-900 font-bold text-[14px] mb-2">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                </div>

                <!-- NIM Field -->
                <div>
                    <label class="block text-slate-900 font-bold text-[14px] mb-2">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                </div>

                <!-- Prodi / Fakultas Field (Dropdown) -->
                <div>
                    <label class="block text-slate-900 font-bold text-[14px] mb-2">Prodi / Fakultas</label>
                    <div class="relative">
                        <select id="prodi" name="prodi" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm appearance-none cursor-pointer">
                            <option value="" disabled selected hidden>Pilih Prodi / Fakultas</option>
                            <option value="s1_ti">S1 Teknologi Informasi</option>
                            <option value="s1_ilkom">S1 Ilmu Komputer</option>
                            <option value="s1_te">S1 Teknik Elektro</option>
                            <option value="s1_tm">S1 Teknik Mesin</option>
                            <option value="s1_ts">S1 Teknik Sipil</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="w-4 h-4 fill-current text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M7 10l5 5 5-5H7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- No. WhatsApp Aktif Field -->
                <div>
                    <label class="block text-slate-900 font-bold text-[14px] mb-2">No. WhatsApp Aktif</label>
                    <input type="tel" id="whatsapp" name="whatsapp" placeholder="Masukkan No. WhatsApp Aktif" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                </div>
            </div>

            <!-- Right Column: Booking & Schedule details -->
            <div class="space-y-4 flex flex-col justify-between">
                
                <div class="space-y-4">
                    <!-- Perihal Peminjaman Field -->
                    <div>
                        <label class="block text-slate-900 font-bold text-[14px] mb-2">Perihal Peminjaman</label>
                        <input type="text" id="perihal" name="perihal" placeholder="Masukkan Perihal Peminjaman" required
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                    </div>

                    <!-- Conditional Section for Kelas Pembelajaran & Kelas Pengganti -->
                    <div id="field_group_kelas" class="space-y-4">
                        <!-- Dosen Field -->
                        <div>
                            <label class="block text-slate-900 font-bold text-[14px] mb-2">Dosen</label>
                            <div class="relative">
                                <select id="select_dosen" name="dosen" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm appearance-none cursor-pointer">
                                    <option value="" disabled selected hidden>Pilih Dosen</option>
                                    <option value="dosen1">Prof. Dr. Ir. H. Supriadi, M.T.</option>
                                    <option value="dosen2">Dr. Eng. Ahmad Munawar, S.T., M.Eng.</option>
                                    <option value="dosen3">Siti Rahmah, S.Kom., M.Cs.</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <svg class="w-4 h-4 fill-current text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M7 10l5 5 5-5H7z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Mata Kuliah Field -->
                        <div>
                            <label class="block text-slate-900 font-bold text-[14px] mb-2">Mata Kuliah</label>
                            <div class="relative">
                                <select id="select_matkul" name="matkul" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm appearance-none cursor-pointer">
                                    <option value="" disabled selected hidden>Pilih Mata Kuliah</option>
                                    <option value="mk1">Pemrograman Web 2</option>
                                    <option value="mk2">Rekayasa Perangkat Lunak</option>
                                    <option value="mk3">Kecerdasan Buatan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <svg class="w-4 h-4 fill-current text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M7 10l5 5 5-5H7z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conditional Section for Kegiatan Kampus -->
                    <div id="field_group_kegiatan" class="space-y-4 hidden">
                        <!-- Nama Kegiatan Field -->
                        <div>
                            <label class="block text-slate-900 font-bold text-[14px] mb-2">Nama Kegiatan</label>
                            <input type="text" id="input_nama_kegiatan" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                        </div>
                    </div>

                    <!-- Tanggal Peminjaman Field -->
                    <div>
                        <label class="block text-slate-900 font-bold text-[14px] mb-2">Tanggal Peminjaman</label>
                        <input type="date" id="tanggal" name="tanggal" required
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-[10px] text-slate-800 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                    </div>

                    <!-- Waktu Mulai & Selesai Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-900 font-bold text-[14px] mb-2">Waktu Mulai</label>
                            <input type="time" id="waktu_mulai" name="waktu_mulai" readonly required
                                   class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-[10px] text-slate-500 cursor-not-allowed focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-slate-900 font-bold text-[14px] mb-2">Waktu Selesai</label>
                            <input type="time" id="waktu_selesai" name="waktu_selesai" readonly required
                                   class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-[10px] text-slate-500 cursor-not-allowed focus:outline-none text-sm">
                        </div>
                    </div>
                </div>

                <!-- Booking Submit Button -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full py-3.5 bg-[#FFB800] hover:bg-[#e0a400] text-white font-bold text-[15px] rounded-[10px] transition-all active:scale-[0.99]">
                        Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Category display toggler javascript -->
<script>
    function handleKategoriChange(val) {
        const fieldKelas = document.getElementById('field_group_kelas');
        const fieldKegiatan = document.getElementById('field_group_kegiatan');
        
        const inputNamaKegiatan = document.getElementById('input_nama_kegiatan');
        const selectDosen = document.getElementById('select_dosen');
        const selectMatkul = document.getElementById('select_matkul');
        
        if (val === 'kegiatan_camp') {
            fieldKelas.classList.add('hidden');
            fieldKegiatan.classList.remove('hidden');
            
            inputNamaKegiatan.required = true;
            selectDosen.required = false;
            selectMatkul.required = false;
        } else {
            fieldKelas.classList.remove('hidden');
            fieldKegiatan.classList.add('hidden');
            
            inputNamaKegiatan.required = false;
            selectDosen.required = true;
            selectMatkul.required = true;
        }
    }
</script>
