<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking | Smart Class Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="h-screen flex flex-col p-6 bg-[#F8FAFC] antialiased overflow-hidden font-['Inter']">


    <!-- Main Dashboard Card Container -->
    <div class="flex-1 flex gap-6 overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-72 bg-[#FFB800] rounded-[24px] shadow-sm flex flex-col justify-between p-8 text-white flex-shrink-0">
            <!-- Top Section: Profile & Navigation -->
            <div>
                <a href="<?= base_url('profil') ?>" class="flex items-center gap-4 mb-10 hover:opacity-90 transition-all cursor-pointer">
                    <div class="w-12 h-12 bg-white rounded-full flex-shrink-0"></div>
                    <div>
                        <h3 class="font-bold text-[17px] leading-tight">Naufal Khalish</h3>
                        <p class="text-[12px] text-white/95 mt-0.5">Mahasiswa</p>
                    </div>
                </a>

                <!-- Navigation Menu -->
                <nav class="space-y-3">
                    <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-4 px-4 py-3 rounded-[14px] font-semibold text-[15px] hover:bg-white/10 transition-all text-white/90">
                        <div class="w-7 h-7 bg-white rounded-full flex-shrink-0"></div>
                        Daftar Ruangan
                    </a>
                    <a href="<?= base_url('history') ?>" class="flex items-center gap-4 px-4 py-3 bg-white/20 rounded-[14px] font-bold text-[15px] transition-all">
                        <div class="w-7 h-7 bg-white rounded-full flex-shrink-0"></div>
                        Riwayat Booking
                    </a>
                </nav>
            </div>

            <!-- Bottom Section: Logout -->
            <a href="<?= base_url('/') ?>" class="flex items-center gap-4 px-4 py-3 rounded-[14px] font-semibold text-[15px] hover:bg-white/10 transition-all text-white/90">
                <div class="w-7 h-7 bg-white rounded-full flex-shrink-0"></div>
                Log Out
            </a>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col bg-white rounded-[24px] shadow-sm border border-slate-100 overflow-hidden">
            
            <!-- Header Row: Back button and Title -->
            <div class="px-10 pt-8 pb-4 flex items-center gap-6">
                <!-- Back Button (Yellow Circle) -->
                <a href="<?= base_url('dashboard') ?>" class="w-12 h-12 bg-[#FFB800] hover:bg-[#e0a400] text-white rounded-full flex items-center justify-center transition-all shadow-sm active:scale-95">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                
                <!-- Page Title -->
                <h2 class="text-[32px] font-bold text-[#FFB800] leading-none">History</h2>
            </div>

            <!-- Booking Cards Grid -->
            <div class="flex-1 overflow-y-auto px-10 py-6">
                <!-- Session Alerts -->
                <?php if (session()->has('success')): ?>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded-[14px] font-semibold">
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-[14px] font-semibold">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 max-w-[1100px]">
                    
                    <?php 
                    $daftar_riwayat = $bookings ?? [
                        [
                            'id' => 1,
                            'room_id' => 1,
                            'nama_ruang' => 'Ruang A14',
                            'fakultas' => 'Fakultas Teknik',
                            'kapasitas' => 35,
                            'kategori_peminjaman' => 'kelas_pembelajaran',
                            'nama' => 'Naufal Khalish',
                            'nim' => '2205551001',
                            'prodi' => 's1_ti',
                            'whatsapp' => '081234567890',
                            'perihal' => 'Kuliah Pemrograman Web 2',
                            'dosen' => 'dosen3',
                            'matkul' => 'mk1',
                            'nama_kegiatan' => '',
                            'tanggal' => '2026-06-16',
                            'waktu_mulai' => '08:00',
                            'waktu_selesai' => '10:00'
                        ],
                        [
                            'id' => 2,
                            'room_id' => 1,
                            'nama_ruang' => 'Ruang A14',
                            'fakultas' => 'Fakultas Teknik',
                            'kapasitas' => 35,
                            'kategori_peminjaman' => 'kelas_pembelajaran',
                            'nama' => 'Naufal Khalish',
                            'nim' => '2205551001',
                            'prodi' => 's1_ti',
                            'whatsapp' => '081234567890',
                            'perihal' => 'Kuliah Pemrograman Web 2',
                            'dosen' => 'dosen3',
                            'matkul' => 'mk1',
                            'nama_kegiatan' => '',
                            'tanggal' => '2026-06-16',
                            'waktu_mulai' => '10:00',
                            'waktu_selesai' => '12:00'
                        ],
                        [
                            'id' => 3,
                            'room_id' => 1,
                            'nama_ruang' => 'Ruang A14',
                            'fakultas' => 'Fakultas Teknik',
                            'kapasitas' => 35,
                            'kategori_peminjaman' => 'kegiatan_camp',
                            'nama' => 'Naufal Khalish',
                            'nim' => '2205551001',
                            'prodi' => 's1_ti',
                            'whatsapp' => '081234567890',
                            'perihal' => 'Kuliah Pemrograman Web 2',
                            'dosen' => '',
                            'matkul' => '',
                            'nama_kegiatan' => 'Sosialisasi PKM',
                            'tanggal' => '2026-06-16',
                            'waktu_mulai' => '13:00',
                            'waktu_selesai' => '15:00'
                        ],
                        [
                            'id' => 4,
                            'room_id' => 1,
                            'nama_ruang' => 'Ruang A14',
                            'fakultas' => 'Fakultas Teknik',
                            'kapasitas' => 35,
                            'kategori_peminjaman' => 'kelas_pembelajaran',
                            'nama' => 'Naufal Khalish',
                            'nim' => '2205551001',
                            'prodi' => 's1_ti',
                            'whatsapp' => '081234567890',
                            'perihal' => 'Kuliah Pemrograman Web 2',
                            'dosen' => 'dosen3',
                            'matkul' => 'mk1',
                            'nama_kegiatan' => '',
                            'tanggal' => '2026-06-16',
                            'waktu_mulai' => '15:00',
                            'waktu_selesai' => '17:00'
                        ]
                    ];
                    foreach ($daftar_riwayat as $b):
                    ?>
                    <!-- Card <?= esc($b['id']) ?> -->
                    <div id="booking_card_<?= esc($b['id']) ?>" onclick="openFormEdit(this)" data-booking="<?= esc(json_encode($b), 'attr') ?>" class="cursor-pointer hover:scale-[1.01] transition-all rounded-[20px] overflow-hidden border border-slate-100 shadow-sm flex flex-col bg-white">
                        <div class="h-48 bg-[#FFF2E6] flex items-center justify-center p-4">
                            <img src="<?= base_url($b['image'] ?? 'asset/image/ilustrasi.png') ?>" alt="<?= esc($b['nama_ruang']) ?> Illustration" class="h-full object-contain">
                        </div>
                        <div class="bg-[#FFB800] p-6 text-white min-h-[110px] relative flex flex-col justify-center">
                            <div>
                                <h4 class="text-[18px] font-bold tracking-wide"><?= esc($b['nama_ruang']) ?></h4>
                                <p class="text-[13px] text-white/80 font-medium mt-0.5"><?= esc($b['fakultas']) ?> - <?= esc($b['kapasitas']) ?> Kursi</p>
                                <p class="text-[11px] text-white/60 font-semibold mt-1"><?= esc($b['tanggal']) ?> | <?= esc($b['waktu_mulai']) ?> - <?= esc($b['waktu_selesai']) ?></p>
                            </div>
                            <!-- Trash Button -->
                            <button onclick="event.stopPropagation(); confirmDeleteBooking(<?= esc($b['id']) ?>)" class="absolute bottom-5 right-6 w-11 h-11 bg-white rounded-full flex items-center justify-center hover:bg-slate-50 transition-all shadow-md active:scale-95">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </main>
    </div>

    <!-- Custom Delete Confirmation Modal -->
    <div id="modalConfirmDelete" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Darkened Background Backdrop -->
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeConfirmDelete()"></div>
        
        <!-- Main Modal Card -->
        <div class="relative w-full max-w-md bg-white rounded-[24px] shadow-2xl p-8 border border-slate-100 animate-in fade-in zoom-in duration-200 flex flex-col items-center text-center gap-6">
            
            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <!-- Title & Subtitle -->
            <div>
                <h3 class="text-xl font-bold text-slate-800">Batalkan Booking</h3>
                <p class="text-sm text-slate-500 mt-2 font-medium">Apakah Anda yakin ingin membatalkan booking ini? Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <!-- Buttons Row -->
            <div class="flex gap-4 w-full mt-2">
                <!-- Batal Button -->
                <button onclick="closeConfirmDelete()" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-[14px] rounded-[14px] transition-all">
                    Batal
                </button>
                <!-- Hapus Button -->
                <button onclick="executeDelete()" class="flex-1 py-3 bg-red-500 hover:bg-red-600 text-white font-bold text-[14px] rounded-[14px] transition-all shadow-sm active:scale-95">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden form for booking cancellation (for backend POST requests) -->
    <form id="formCancelBooking" action="<?= base_url('booking/delete') ?>" method="POST" class="hidden">
        <?= csrf_field() ?>
        <input type="hidden" name="id_booking" id="cancel_id_booking" value="">
    </form>

    <!-- Include Form Edit Overlay View -->
    <?= view('user/formEdit') ?>

    <!-- JavaScript to handle booking deletion & edit -->
    <script>
        let deleteTargetId = null;

        function confirmDeleteBooking(id) {
            deleteTargetId = id;
            document.getElementById('modalConfirmDelete').classList.remove('hidden');
        }

        function closeConfirmDelete() {
            deleteTargetId = null;
            document.getElementById('modalConfirmDelete').classList.add('hidden');
        }

        function executeDelete() {
            if (deleteTargetId) {
                const form = document.getElementById('formCancelBooking');
                const cancelInput = document.getElementById('cancel_id_booking');
                if (form && cancelInput) {
                    cancelInput.value = deleteTargetId;
                    form.submit();
                } else {
                    const card = document.getElementById('booking_card_' + deleteTargetId);
                    if (card) {
                        card.remove();
                    }
                    alert("Booking berhasil dibatalkan!");
                    closeConfirmDelete();
                }
            }
        }

        // Modal Form Edit Handlers
        function openFormEdit(elem) {
            const dataStr = elem.getAttribute('data-booking');
            if (!dataStr) return;
            const data = JSON.parse(dataStr);
            
            // Populate form fields
            document.getElementById('edit_id_booking').value = data.id || "";
            document.getElementById('edit_nama').value = data.nama || "";
            document.getElementById('edit_nim').value = data.nim || "";
            document.getElementById('edit_prodi').value = data.prodi || "";
            document.getElementById('edit_whatsapp').value = data.whatsapp || "";
            document.getElementById('edit_perihal').value = data.perihal || "";
            document.getElementById('edit_kategori_peminjaman').value = data.kategori_peminjaman || "";
            
            if (data.kategori_peminjaman === 'kegiatan_camp') {
                document.getElementById('edit_input_nama_kegiatan').value = data.nama_kegiatan || "";
                document.getElementById('edit_field_group_kelas').classList.add('hidden');
                document.getElementById('edit_field_group_kegiatan').classList.remove('hidden');
            } else {
                document.getElementById('edit_select_dosen').value = data.dosen || "";
                document.getElementById('edit_select_matkul').value = data.matkul || "";
                document.getElementById('edit_field_group_kelas').classList.remove('hidden');
                document.getElementById('edit_field_group_kegiatan').classList.add('hidden');
            }
            
            document.getElementById('edit_tanggal').value = data.tanggal || "";
            document.getElementById('edit_waktu_mulai').value = data.waktu_mulai || "";
            document.getElementById('edit_waktu_selesai').value = data.waktu_selesai || "";
            
            // Show the modal
            document.getElementById('modalFormEdit').classList.remove('hidden');
        }
        
        function closeFormEdit() {
            document.getElementById('modalFormEdit').classList.add('hidden');
        }
    </script>

</body>
</html>
