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
<body class="h-screen overflow-hidden antialiased bg-slate-50 font-['Inter']">

<div class="flex h-screen">
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col z-30">
        <div class="p-8 flex items-center gap-3 border-b border-slate-50">
            <div class="w-9 h-9 bg-[#F48200] rounded-lg flex items-center justify-center text-white shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <span class="text-lg font-bold text-slate-800 tracking-tight uppercase">Smart Class</span>
        </div>

        <nav class="flex-1 p-6 space-y-2">
            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-slate-100 text-[#F48200] rounded-xl font-semibold text-sm transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V2z"></path></svg>
                Daftar Ruangan
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl transition-all text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat Booking
            </a>
        </nav>

        <div class="p-6 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-10 h-10 bg-slate-200 rounded-full flex-shrink-0"></div>
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold text-slate-800 truncate">Naufal Khalish</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Mahasiswa</p>
                </div>
            </div>
            <button class="w-full py-2.5 text-slate-400 hover:text-red-500 text-xs font-bold transition-all text-left uppercase tracking-widest px-2">Log Out</button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-10">
            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Eksplorasi Ruangan</h2>
            <div class="relative w-80">
                <input type="text" placeholder="Cari ruangan..." class="w-full bg-slate-50 border-none rounded-xl py-2.5 px-10 text-sm focus:ring-2 focus:ring-[#F48200] transition-all">
                <svg class="w-4 h-4 absolute left-4 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-10 bg-slate-50">
            <div class="flex gap-3 mb-8">
                <button class="px-6 py-2 bg-slate-800 text-white rounded-lg text-sm font-semibold shadow-sm">Semua</button>
                <button class="px-6 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 transition-all">Lantai 1</button>
                <button class="px-6 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 transition-all">Lantai 2</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card-pro overflow-hidden group">
                    <div class="h-44 bg-slate-100 relative flex items-center justify-center overflow-hidden">
                        <div class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur-md px-3 py-1 rounded-md text-[10px] font-bold text-green-600 border border-green-100 shadow-sm">TERSEDIA</div>
                        <svg class="w-16 h-16 text-slate-200 group-hover:scale-110 transition-transform duration-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-slate-800 mb-1 uppercase tracking-tight">Ruang A.1.1</h4>
                        <p class="text-xs text-slate-500 font-medium mb-6">Gedung Utama • 40 Kursi • AC</p>
                        <button onclick="openModal()" class="btn-pro w-full text-xs py-3.5 shadow-sm">Booking Ruangan</button>
                    </div>
                </div>

                <div class="card-pro overflow-hidden opacity-60 grayscale-[0.3]">
                    <div class="h-44 bg-slate-200 relative flex items-center justify-center">
                        <div class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur-md px-3 py-1 rounded-md text-[10px] font-bold text-slate-400 border border-slate-200 shadow-sm uppercase italic">Terpakai</div>
                        <span class="text-slate-300 font-bold text-[10px] uppercase tracking-widest">In Use s/d 14:00</span>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-slate-400 mb-1 uppercase tracking-tight italic">Ruang A.1.2</h4>
                        <p class="text-xs text-slate-400 font-medium mb-6 italic tracking-tight">Sudah Terisi oleh Himpunan</p>
                        <button disabled class="w-full py-3.5 bg-slate-100 text-slate-400 rounded-xl text-xs font-bold cursor-not-allowed">Terisi</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

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
                <input type="text" placeholder="Masukkan nama kegiatan" class="input-pro text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Mulai</label>
                    <input type="time" class="input-pro text-sm">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">Selesai</label>
                    <input type="time" class="input-pro text-sm">
                </div>
            </div>
            <div class="pt-6 flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">BATAL</button>
                <button type="submit" class="flex-[2] btn-pro text-xs">Konfirmasi Booking</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() { document.getElementById('modalBooking').classList.remove('hidden'); }
    function closeModal() { document.getElementById('modalBooking').classList.add('hidden'); }
</script>

</body>
</html>