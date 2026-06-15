<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Slot Waktu | Smart Class Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F8FAFC] min-h-screen p-6 flex flex-col font-['Inter'] antialiased">



    <!-- Main Container Card -->
    <div class="flex-1 bg-white rounded-[24px] shadow-sm border border-slate-100 overflow-hidden flex flex-col w-full">
        
        <!-- Header Banner Image -->
        <div class="h-56 bg-[#FFF2E6] relative flex items-center justify-center overflow-hidden">
            <div class="max-w-[1200px] w-full h-full mx-auto relative">
                <img src="<?= base_url('asset/image/ilustrasi.png') ?>" alt="Header Banner" class="w-full h-full object-cover opacity-90">
            </div>
        </div>

        <!-- Content Split Section -->
        <div class="p-8 md:p-12 flex flex-col lg:flex-row gap-16 lg:gap-36 max-w-[1200px] w-full mx-auto">
            
            <!-- Left Column: Slot Selector -->
            <div class="flex-1">
                <!-- Small Back Arrow -->
                <a href="<?= base_url('dashboard') ?>" class="text-slate-700 hover:text-slate-900 mb-6 inline-block">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>

                <!-- Title -->
                <?php $ruangan_nama = $room['nama'] ?? 'Ruang A14'; ?>
                <h2 class="text-[32px] font-bold text-[#FFB800] mb-8 leading-tight"><?= esc($ruangan_nama) ?></h2>

                <!-- Pilih Jam Header & Legend -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <h3 class="font-bold text-slate-800 text-[18px]">Pilih Jam</h3>
                    
                    <!-- Legend -->
                    <div class="flex items-center gap-4 text-xs font-semibold text-slate-500">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3.5 bg-[#00A859] rounded-[3px] block"></span>
                            Dipilih
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3.5 bg-[#D89F9F] rounded-[3px] block"></span>
                            Dibooking
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3.5 h-3.5 bg-[#9CBFA8] rounded-[3px] block"></span>
                            Tersedia
                        </div>
                    </div>
                </div>

                <!-- Grid of Time Buttons -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
                    <?php 
                    $daftar_slot = $slots ?? [
                        ['waktu' => '08:00', 'status' => 'Tersedia'],
                        ['waktu' => '10:00', 'status' => 'Tersedia'],
                        ['waktu' => '12:00', 'status' => 'Dibooking'],
                        ['waktu' => '14:00', 'status' => 'Tersedia'],
                        ['waktu' => '16:00', 'status' => 'Tersedia'],
                        ['waktu' => '18:00', 'status' => 'Tersedia'],
                        ['waktu' => '20:00', 'status' => 'Tersedia'],
                        ['waktu' => '22:00', 'status' => 'Tersedia'],
                    ];
                    foreach ($daftar_slot as $s):
                        $is_booked = strtolower($s['status']) === 'dibooking';
                        $is_selected = strtolower($s['status']) === 'dipilih';
                        
                        if ($is_booked):
                    ?>
                        <button class="py-4 bg-[#D89F9F] text-white rounded-[10px] font-bold text-[15px] text-center cursor-not-allowed" disabled><?= esc($s['waktu']) ?></button>
                    <?php elseif ($is_selected): ?>
                        <button onclick="toggleSlot(this)" class="py-4 bg-[#00A859] text-white rounded-[10px] font-bold text-[15px] hover:opacity-90 transition-all text-center"><?= esc($s['waktu']) ?></button>
                    <?php else: ?>
                        <button onclick="toggleSlot(this)" class="py-4 bg-[#9CBFA8] text-white rounded-[10px] font-bold text-[15px] hover:opacity-90 transition-all text-center"><?= esc($s['waktu']) ?></button>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>

                <!-- Next Action Button -->
                <button onclick="openFormAdd()" class="w-full py-4 bg-[#FFB800] hover:bg-[#e0a400] text-white font-bold text-[16px] rounded-[14px] transition-all active:scale-[0.99] shadow-sm">
                    Next
                </button>
            </div>

            <!-- Right Column: Information lists -->
            <div class="w-full lg:w-96 flex flex-col gap-10">
                <!-- Instructions List -->
                <div>
                    <h3 class="font-bold text-slate-800 text-[18px] mb-4">Cara Booking</h3>
                    <ol class="list-decimal pl-5 space-y-2 text-[13.5px] text-slate-600 font-medium leading-relaxed">
                        <?php 
                        $daftar_instruksi = $instructions ?? [
                            'Pilih ruangan yang ingin digunakan.',
                            'Pilih slot waktu yang berstatus Tersedia.',
                            'Pastikan jadwal yang dipilih sudah sesuai kebutuhan.',
                            'Klik tombol Booking untuk mengajukan pemesanan.',
                            'Tunggu konfirmasi hingga booking berhasil dan jadwal tercatat pada sistem.',
                        ];
                        foreach ($daftar_instruksi as $inst):
                        ?>
                            <li><?= esc($inst) ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <!-- Facilities List -->
                <div>
                    <h3 class="font-bold text-slate-800 text-[18px] mb-4">Fasilitas</h3>
                    <ol class="list-decimal pl-5 space-y-2 text-[13.5px] text-slate-600 font-medium leading-relaxed">
                        <?php 
                        $daftar_fasilitas = $facilities ?? [
                            'Komputer praktikum.',
                            'Proyektor dan layar presentasi.',
                            'Akses internet/Wi-Fi.',
                            'AC dan pencahayaan yang memadai.',
                            'Whiteboard dan perlengkapan penunjang pembelajaran.',
                        ];
                        foreach ($daftar_fasilitas as $fac):
                        ?>
                            <li><?= esc($fac) ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>

        </div>
    </div>

    <!-- Include Form Add Overlay View -->
    <?= view('user/formAdd') ?>

    <!-- JavaScript Interactivity -->
    <script>
        function toggleSlot(btn) {
            // Ignore if disabled/booked
            if (btn.hasAttribute('disabled') || btn.classList.contains('bg-[#D89F9F]')) {
                return;
            }
            
            // Check if the clicked button is already selected
            const isAlreadySelected = btn.classList.contains('bg-[#00A859]');
            
            // Deselect all selected slots first (ensures singleselect)
            const allButtons = document.querySelectorAll('button[onclick]');
            allButtons.forEach(b => {
                if (b.classList.contains('bg-[#00A859]')) {
                    b.classList.remove('bg-[#00A859]');
                    b.classList.add('bg-[#9CBFA8]');
                }
            });
            
            const inputMulai = document.getElementById('waktu_mulai');
            const inputSelesai = document.getElementById('waktu_selesai');
            
            if (!isAlreadySelected) {
                // Select this slot
                btn.classList.remove('bg-[#9CBFA8]');
                btn.classList.add('bg-[#00A859]');
                
                // Populate form fields
                const timeVal = btn.textContent.trim(); // e.g. "08:00"
                if (inputMulai && inputSelesai) {
                    inputMulai.value = timeVal;
                    
                    // Automatically set end time to 2 hours later (e.g. "10:00")
                    const parts = timeVal.split(':');
                    let hours = parseInt(parts[0], 10);
                    let mins = parseInt(parts[1], 10);
                    hours = (hours + 2) % 24;
                    const endVal = (hours < 10 ? '0' : '') + hours + ':' + (mins < 10 ? '0' : '') + mins;
                    inputSelesai.value = endVal;
                }
            } else {
                // Deselected: clear fields
                if (inputMulai && inputSelesai) {
                    inputMulai.value = '';
                    inputSelesai.value = '';
                }
            }
        }

        // Modal Form Add Handlers
        function openFormAdd() {
            const inputMulai = document.getElementById('waktu_mulai');
            if (!inputMulai || !inputMulai.value) {
                showAlert('Silakan pilih slot waktu terlebih dahulu!');
                return;
            }
            document.getElementById('modalFormAdd').classList.remove('hidden');
        }
        
        function closeFormAdd() {
            document.getElementById('modalFormAdd').classList.add('hidden');
        }

        // Custom Alert Handlers
        function showAlert(msg) {
            document.getElementById('alertMessage').textContent = msg;
            document.getElementById('modalAlert').classList.remove('hidden');
        }

        function closeAlert() {
            document.getElementById('modalAlert').classList.add('hidden');
        }
    </script>

    <!-- Custom Alert Modal -->
    <div id="modalAlert" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Darkened Background Backdrop -->
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeAlert()"></div>
        
        <!-- Main Modal Card -->
        <div class="relative w-full max-w-md bg-white rounded-[24px] shadow-2xl p-8 border border-slate-100 animate-in fade-in zoom-in duration-200 flex flex-col items-center text-center gap-6">
            
            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <!-- Title & Subtitle -->
            <div>
                <h3 class="text-xl font-bold text-slate-800">Pemberitahuan</h3>
                <p id="alertMessage" class="text-sm text-slate-500 mt-2 font-medium">Silakan pilih slot waktu terlebih dahulu!</p>
            </div>

            <!-- Buttons Row -->
            <div class="w-full mt-2">
                <!-- OK Button -->
                <button onclick="closeAlert()" class="w-full py-3 bg-[#FFB800] hover:bg-[#e0a400] text-white font-bold text-[14px] rounded-[14px] transition-all shadow-sm active:scale-[0.99]">
                    Ok
                </button>
            </div>
        </div>
    </div>

</body>
</html>
