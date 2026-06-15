<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Smart Class Booking</title>
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
                    <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-4 px-4 py-3 bg-white/20 rounded-[14px] font-bold text-[15px] transition-all">
                        <div class="w-7 h-7 bg-white rounded-full flex-shrink-0"></div>
                        Daftar Ruangan
                    </a>
                    <a href="<?= base_url('history') ?>" class="flex items-center gap-4 px-4 py-3 rounded-[14px] font-semibold text-[15px] hover:bg-white/10 transition-all text-white/90">
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
            <!-- Search Header -->
            <div class="px-10 pt-8 pb-4">
                <div class="relative w-full max-w-[850px]">
                    <input type="text" id="searchRoom" oninput="filterSearch()" placeholder="Cari Ruangan" 
                           class="w-full bg-slate-100/80 border-none rounded-full py-4 pl-14 pr-6 text-[15px] focus:outline-none focus:ring-2 focus:ring-[#FFB800] text-slate-800 placeholder-slate-400">
                    <svg class="w-5 h-5 absolute left-6 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="px-10 py-3 flex gap-4">
                <button onclick="filterFloor('all', this)" class="px-10 py-3.5 bg-[#FFB800] text-white rounded-[14px] text-[15px] font-bold shadow-sm transition-all">Semua</button>
                <button onclick="filterFloor('1', this)" class="px-10 py-3.5 bg-[#D9D9D9] text-white rounded-[14px] text-[15px] font-bold hover:bg-slate-300 transition-all">Lantai 1</button>
                <button onclick="filterFloor('2', this)" class="px-10 py-3.5 bg-[#D9D9D9] text-white rounded-[14px] text-[15px] font-bold hover:bg-slate-300 transition-all">Lantai 2</button>
            </div>

            <!-- Cards Grid Section -->
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
                    $daftar_ruangan = $rooms ?? [
                        ['id' => 1, 'nama' => 'Ruang A11', 'lantai' => 1, 'kapasitas' => 35, 'status' => 'Tersedia', 'fakultas' => 'Fakultas Teknik'],
                        ['id' => 2, 'nama' => 'Ruang A12', 'lantai' => 1, 'kapasitas' => 35, 'status' => 'Penuh', 'fakultas' => 'Fakultas Teknik'],
                        ['id' => 3, 'nama' => 'Ruang B21', 'lantai' => 2, 'kapasitas' => 35, 'status' => 'Penuh', 'fakultas' => 'Fakultas Teknik'],
                        ['id' => 4, 'nama' => 'Ruang B22', 'lantai' => 2, 'kapasitas' => 35, 'status' => 'Tersedia', 'fakultas' => 'Fakultas Teknik'],
                    ];
                    foreach ($daftar_ruangan as $r):
                        $is_tersedia = strtolower($r['status']) === 'tersedia';
                        $status_color_class = $is_tersedia ? 'text-green-600' : 'text-red-600';
                    ?>
                    <!-- Card: <?= esc($r['nama']) ?> -->
                    <div data-lantai="<?= esc($r['lantai']) ?>" class="rounded-[20px] overflow-hidden border border-slate-100 shadow-sm flex flex-col bg-white">
                        <div class="h-48 bg-[#FFF2E6] flex items-center justify-center p-4">
                            <img src="<?= base_url($r['image'] ?? 'asset/image/ilustrasi.png') ?>" alt="<?= esc($r['nama']) ?> Illustration" class="h-full object-contain">
                        </div>
                        <div class="bg-[#FFB800] p-6 text-white flex flex-col justify-between flex-1">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-[18px] font-bold tracking-wide"><?= esc($r['nama']) ?></h4>
                                    <p class="text-[13px] text-white/80 font-medium mt-0.5"><?= esc($r['fakultas'] ?? 'Fakultas Teknik') ?> - Lantai <?= esc($r['lantai']) ?> - <?= esc($r['kapasitas']) ?> Kursi</p>
                                </div>
                                <span class="bg-white <?= $status_color_class ?> font-extrabold text-[12px] px-3.5 py-1.5 rounded-[8px]"><?= esc($r['status']) ?></span>
                            </div>
                            <a href="<?= base_url('slot?room_id=' . esc($r['id'])) ?>" class="w-full py-3 bg-[#E09800] hover:bg-[#c98900] text-white font-bold text-[14px] rounded-[10px] transition-all block text-center">
                                Booking
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </main>
    </div>

    <!-- Booking Modal -->
    <div id="modalBooking" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <h3 class="text-lg font-bold text-slate-800">Booking Reservasi</h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="#" class="p-8 space-y-5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Nama Kegiatan</label>
                    <input type="text" placeholder="Masukkan nama kegiatan" class="w-full bg-slate-50 border border-slate-200 rounded-[10px] p-3 text-slate-800 placeholder-slate-300 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Mulai</label>
                        <input type="time" class="w-full bg-slate-50 border border-slate-200 rounded-[10px] p-3 text-slate-800 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Selesai</label>
                        <input type="time" class="w-full bg-slate-50 border border-slate-200 rounded-[10px] p-3 text-slate-800 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-sm">
                    </div>
                </div>
                <div class="pt-6 flex gap-3">
                    <button type="button" onclick="closeModal()" class="flex-1 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">BATAL</button>
                    <button type="submit" class="flex-[2] py-3 bg-[#FFB800] hover:bg-[#e0a400] text-white font-bold text-[14px] rounded-[10px] transition-all">Konfirmasi Booking</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() { document.getElementById('modalBooking').classList.remove('hidden'); }
        function closeModal() { document.getElementById('modalBooking').classList.add('hidden'); }

        let activeFloor = 'all';

        function filterFloor(floor, btn) {
            activeFloor = floor;
            
            // Update button styles
            const buttons = btn.parentElement.querySelectorAll('button');
            buttons.forEach(b => {
                b.classList.remove('bg-[#FFB800]', 'text-white', 'shadow-sm');
                b.classList.add('bg-[#D9D9D9]', 'text-white', 'hover:bg-slate-300');
            });
            btn.classList.remove('bg-[#D9D9D9]', 'hover:bg-slate-300');
            btn.classList.add('bg-[#FFB800]', 'text-white', 'shadow-sm');
            
            // Execute filtering
            applyFilters();
        }

        function filterSearch() {
            applyFilters();
        }

        function applyFilters() {
            const query = document.getElementById('searchRoom').value.toLowerCase().trim();
            const cards = document.querySelectorAll('[data-lantai]');
            
            cards.forEach(card => {
                const lantai = card.getAttribute('data-lantai');
                const title = card.querySelector('h4').textContent.toLowerCase();
                const subtitle = card.querySelector('p').textContent.toLowerCase();
                
                const matchesFloor = (activeFloor === 'all' || lantai === activeFloor);
                const matchesSearch = (title.includes(query) || subtitle.includes(query));
                
                if (matchesFloor && matchesSearch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>