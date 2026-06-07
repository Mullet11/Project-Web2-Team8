<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Smart Class Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden bg-[#FFFCE5] antialiased font-['Nunito'] text-[#856404]">

<div class="flex h-screen p-4 md:p-6 gap-6">

    <aside class="hidden lg:flex w-72 flex-col justify-between bg-white rounded-[40px] p-8 border border-[#FBE551]/30 shadow-sm">
        <div>
            <div class="flex items-center gap-3 mb-12">
                <div class="w-11 h-11 bg-[#F48200] rounded-2xl flex items-center justify-center shadow-lg text-white font-black text-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <span class="text-2xl font-black text-[#F48200] tracking-tighter uppercase font-black">Smart Class</span>
            </div>

            <nav class="space-y-3">
                <a href="#" class="flex items-center gap-4 p-4 bg-[#F48200] text-white rounded-2xl shadow-lg font-black">
                    <span>Daftar Ruang</span>
                </a>
                <a href="#" class="flex items-center gap-4 p-4 text-[#F6BB0A] hover:bg-[#FDE88D]/20 rounded-2xl font-black transition-all">
                    <span>Peminjaman</span>
                </a>
            </nav>
        </div>

        <div class="bg-[#FDE88D]/10 p-6 rounded-[30px] border border-[#FBE551]/30">
            <div class="flex items-center gap-3 mb-6 text-center">
                <div class="w-12 h-12 bg-[#F9D342] mx-auto rounded-full border-2 border-white shadow-sm"></div>
                <div class="overflow-hidden flex-1 text-left">
                    <p class="text-sm font-black text-[#F48200] truncate">User Name</p>
                    <p class="text-[10px] font-black text-[#F6BB0A] uppercase tracking-widest italic">Mahasiswa</p>
                </div>
            </div>
            <button class="w-full py-3 bg-[#FFF4A3] text-[#F48200] rounded-xl font-black text-xs uppercase tracking-widest hover:bg-[#F48200] hover:text-white transition-all">
                Log Out
            </button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full bg-white rounded-[40px] border border-gray-100 overflow-hidden shadow-sm">

        <header class="p-8 md:p-12 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-4xl font-black text-[#F48200] tracking-tighter uppercase font-black leading-none">Eksplorasi Ruang</h2>
                <p class="text-[#F6BB0A] font-bold text-lg">Fakultas Teknik ULM</p>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="text" placeholder="Cari ruangan..." class="w-72 bg-[#FDE88D]/10 border-2 border-[#FBE551]/20 rounded-2xl py-4 px-12 font-bold text-[#F48200] focus:outline-none focus:border-[#F48200] focus:bg-white transition-all shadow-sm">
                    <svg class="w-6 h-6 absolute left-4 top-4 text-[#F9D342]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </header>

        <section class="flex-1 overflow-y-auto p-8 md:p-12 pt-0">
            <div class="flex gap-4 mb-12 overflow-x-auto pb-2 justify-center lg:justify-start">
                <button class="px-8 py-3 bg-[#F48200] text-white rounded-full font-black text-xs uppercase tracking-widest shadow-lg">Semua</button>
                <button class="px-8 py-3 bg-[#FDE88D]/30 text-[#F6BB0A] rounded-full font-black text-xs uppercase tracking-widest hover:bg-[#FDE88D]/50 transition-all text-nowrap">Lantai 1</button>
                <button class="px-8 py-3 bg-[#FDE88D]/30 text-[#F6BB0A] rounded-full font-black text-xs uppercase tracking-widest hover:bg-[#FDE88D]/50 transition-all text-nowrap">Lantai 2</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">

                <!-- CARD 1 (Tersedia) -->
                <div class="group bg-white rounded-[40px] border-2 border-[#FBE551]/10 p-2 shadow-sm hover:shadow-2xl transition-all hover:-translate-y-1">
                    <div class="relative h-52 rounded-[35px] overflow-hidden bg-[#FDE88D]/10">
                        <div class="absolute top-5 right-5 z-10 bg-white/90 backdrop-blur-md px-5 py-2 rounded-full shadow-sm">
                            <span class="flex items-center gap-2 text-[11px] font-black text-green-500 uppercase italic">
                                <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span> Tersedia
                            </span>
                        </div>
                        <div class="w-full h-full flex items-center justify-center text-[#F9D342] opacity-30">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        </div>
                    </div>
                    <div class="p-8">
                        <h4 class="text-3xl font-black text-[#F48200] tracking-tighter uppercase mb-2">Ruang A.1.1</h4>
                        <p class="font-bold text-sm uppercase italic tracking-widest text-[#F6BB0A] mb-8 uppercase">Lantai 1 • 40 Kursi</p>
                        <button onclick="openModal()" class="w-full bg-[#F48200] text-white py-5 rounded-[22px] font-black text-sm uppercase tracking-widest shadow-xl hover:bg-[#F6BB0A] transition-all transform active:scale-95">
                            Booking Sekarang
                        </button>
                    </div>
                </div>

                <!-- CARD 2 (Terpakai) -->
                <div class="bg-white rounded-[40px] border-2 border-gray-50 p-2 shadow-sm opacity-50 grayscale-[0.3]">
                    <div class="relative h-52 rounded-[35px] overflow-hidden bg-gray-50">
                        <div class="absolute top-5 right-5 z-10 bg-white/90 backdrop-blur-md px-5 py-2 rounded-full shadow-sm">
                            <span class="flex items-center gap-2 text-[11px] font-black text-red-400 uppercase italic">
                                <span class="w-2.5 h-2.5 bg-red-400 rounded-full"></span> Terpakai
                            </span>
                        </div>
                        <div class="w-full h-full flex items-center justify-center text-gray-200 font-black text-xs tracking-widest italic uppercase">
                            In Use s/d 14:00
                        </div>
                    </div>
                    <div class="p-8">
                        <h4 class="text-3xl font-black text-gray-400 tracking-tighter uppercase mb-2">Ruang A.1.2</h4>
                        <p class="font-bold text-sm uppercase italic tracking-widest text-gray-300 mb-8 uppercase">Lantai 1 • 30 Kursi</p>
                        <button disabled class="w-full bg-gray-50 text-gray-200 py-5 rounded-[22px] font-black text-sm uppercase tracking-widest cursor-not-allowed">
                            Terisi
                        </button>
                    </div>
                </div>

            </div>
        </section>
    </main>
</div>

<div id="modalBooking" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-[#856404]/40 backdrop-blur-sm"></div>
    <div class="relative w-full max-w-lg bg-white rounded-[40px] shadow-2xl overflow-hidden border border-[#FBE551]/30">
        <div class="p-8 bg-[#F48200] text-white flex justify-between items-center font-black">
            <div>
                <h3 class="text-2xl font-black uppercase tracking-tight">Form Reservasi</h3>
                <p class="text-[10px] font-black opacity-80 uppercase tracking-widest">Ruang A.1.1 • Gedung Utama</p>
            </div>
            <button onclick="closeModal()" class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full hover:bg-white/40 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="#" class="p-8 space-y-5">
            <div>
                <label class="block text-[11px] font-black text-[#F48200] mb-2 ml-1 uppercase tracking-widest">Nama Kegiatan</label>
                <input type="text" placeholder="Contoh: Rapat Himpunan" class="w-full bg-[#FDE88D]/10 border-2 border-[#FBE551]/30 rounded-2xl py-4 px-6 font-bold text-[#F48200] focus:outline-none focus:border-[#F48200] transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-black text-[#F48200] mb-2 ml-1 uppercase tracking-widest">Waktu Mulai</label>
                    <input type="time" class="w-full bg-[#FDE88D]/10 border-2 border-[#FBE551]/30 rounded-2xl py-4 px-6 font-bold text-[#F48200] focus:outline-none focus:border-[#F48200] transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-[#F48200] mb-2 ml-1 uppercase tracking-widest">Waktu Selesai</label>
                    <input type="time" class="w-full bg-[#FDE88D]/10 border-2 border-[#FBE551]/30 rounded-2xl py-4 px-6 font-bold text-[#F48200] focus:outline-none focus:border-[#F48200] transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-black text-[#F48200] mb-2 ml-1 uppercase tracking-widest">Keterangan</label>
                <textarea rows="3" placeholder="Opsional..." class="w-full bg-[#FDE88D]/10 border-2 border-[#FBE551]/30 rounded-2xl py-4 px-6 font-bold text-[#F48200] focus:outline-none focus:border-[#F48200] transition-all"></textarea>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="button" onclick="closeModal()" class="flex-1 py-4 text-[#F6BB0A] font-black uppercase tracking-widest text-xs hover:underline">Batal</button>
                <button type="submit" class="flex-[2] bg-[#F48200] text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl hover:bg-[#F6BB0A] transition-all transform active:scale-95 shadow-[#F48200]/20">
                    Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalBooking').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modalBooking').classList.add('hidden');
    }
</script>

</body>
</html>