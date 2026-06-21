<!-- Booking Detail Modal Overlay (Dark background backdrop) -->
<div id="booking-detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 opacity-0 pointer-events-none transition-opacity duration-300 select-none">
    <!-- Backdrop overlay to make background dark and blurred -->
    <div id="booking-detail-modal-backdrop" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeBookingDetailModal()"></div>

    <!-- Modal Window Container -->
    <div id="booking-detail-modal-content" class="bg-white rounded-[32px] border border-slate-100 shadow-2xl w-full max-w-[95%] sm:max-w-md max-h-[90vh] overflow-y-auto relative z-10 transform scale-95 opacity-0 transition-all duration-300 flex flex-col mx-auto">
        
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/40 sticky top-0 z-10">
            <div>
                <h3 class="text-xl font-black text-slate-950 tracking-tight">Detail Jadwal Ruangan</h3>
                <p class="text-xs font-semibold text-slate-400 mt-0.5" id="detail-room-subtitle"></p>
            </div>
            <!-- Close button -->
            <button type="button" onclick="closeBookingDetailModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition-colors cursor-pointer focus:outline-none shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-6">
            <!-- Time slot and Status badge -->
            <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div class="space-y-0.5">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Waktu Penggunaan</p>
                    <p class="text-lg font-black text-slate-800" id="detail-time-text"></p>
                </div>
                <span id="detail-status-badge" class="px-3 py-1 text-[10px] font-black rounded-lg uppercase tracking-wider select-none"></span>
            </div>

            <!-- Subject & Activity -->
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider" id="detail-activity-label">Mata Kuliah / Kegiatan</p>
                <p class="text-base font-extrabold text-slate-900 leading-snug" id="detail-subject-text"></p>
            </div>

            <!-- Detailed Grid Info -->
            <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                <!-- Lecturer / PIC -->
                <div class="space-y-0.5" id="detail-lecturer-container">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider" id="detail-pic-label">Dosen</p>
                    <p class="text-xs font-black text-slate-700" id="detail-pic-text"></p>
                </div>
                <!-- Class / Proctor -->
                <div class="space-y-0.5" id="detail-class-container">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider" id="detail-prodi-label">Kelas / Program Studi</p>
                    <p class="text-xs font-black text-slate-700" id="detail-prodi-text"></p>
                </div>
                <!-- Submitter (NIM) -->
                <div class="space-y-0.5 col-span-2 border-t border-slate-200/60 pt-2.5">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pemesan (PIC)</p>
                    <p class="text-xs font-black text-slate-700" id="detail-sender-text"></p>
                </div>
            </div>

            <!-- Action Button: Contact via WhatsApp -->
            <a href="#" id="detail-whatsapp-btn" target="_blank"
                class="w-full py-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 text-sm font-extrabold rounded-xl flex items-center justify-center gap-2 border border-emerald-100 transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.665.989 3.3 1.472 5.358 1.473 5.467 0 9.914-4.444 9.918-9.909.002-2.646-1.02-5.136-2.889-7.001C17.16 1.85 14.678.826 12.01.826c-5.468 0-9.915 4.445-9.919 9.91-.001 2.115.56 4.18 1.624 5.995l-1.064 3.887 3.996-1.048zm11.238-6.197c-.272-.136-1.61-.794-1.859-.885-.25-.091-.432-.136-.613.136-.182.273-.705.885-.863 1.067-.159.182-.318.205-.59.069-.272-.136-1.15-.424-2.19-1.353-.809-.721-1.355-1.613-1.514-1.886-.159-.273-.017-.42.119-.556.122-.122.272-.318.409-.477.136-.159.182-.272.272-.454.091-.181.045-.341-.023-.477-.068-.136-.613-1.477-.84-2.023-.222-.534-.488-.46-.613-.466-.12-.005-.272-.006-.432-.006-.159 0-.417.06-.634.295-.218.236-.832.813-.832 1.984 0 1.171.852 2.302.97 2.461.119.159 1.674 2.557 4.057 3.586.567.245 1.01.391 1.356.501.57.181 1.088.156 1.498.094.457-.069 1.61-.659 1.838-1.295.227-.636.227-1.182.159-1.295-.068-.113-.25-.205-.522-.341z" />
                </svg>
                <span>Hubungi Penanggung Jawab (WA)</span>
            </a>
        </div>
    </div>
</div>

<script>
    function openBookingDetailModal(details) {
        const modal = document.getElementById('booking-detail-modal');
        const backdrop = document.getElementById('booking-detail-modal-backdrop');
        const content = document.getElementById('booking-detail-modal-content');

        // Fill modal fields
        document.getElementById('detail-room-subtitle').textContent = `Informasi Pemakaian Ruangan`;
        document.getElementById('detail-time-text').textContent = `${details.time} WIB`;
        
        // Status Badge
        const statusBadge = document.getElementById('detail-status-badge');
        if (details.status === 'diproses') {
            statusBadge.className = "px-3 py-1 text-[10px] font-black rounded-lg uppercase tracking-wider select-none bg-amber-50 text-amber-600 border border-amber-250";
            statusBadge.textContent = "Diproses (Review)";
        } else {
            statusBadge.className = "px-3 py-1 text-[10px] font-black rounded-lg uppercase tracking-wider select-none bg-rose-50 text-rose-600 border border-rose-250";
            statusBadge.textContent = "Terpakai (Disetujui)";
        }

        // Display activity / subject
        document.getElementById('detail-subject-text').textContent = details.subject || '-';

        // Adjust labels based on perihal
        const picLabel = document.getElementById('detail-pic-label');
        const prodiLabel = document.getElementById('detail-prodi-label');
        const picText = document.getElementById('detail-pic-text');
        const prodiText = document.getElementById('detail-prodi-text');

        if (details.perihal === 'Perkuliahan') {
            document.getElementById('detail-activity-label').textContent = "Mata Kuliah";
            picLabel.textContent = "Dosen Pengampu";
            picText.textContent = details.dosen || '-';
            prodiLabel.textContent = "Program Studi / Kelas";
            prodiText.textContent = details.prodi || '-';
        } else {
            document.getElementById('detail-activity-label').textContent = "Nama Kegiatan";
            picLabel.textContent = "Penanggung Jawab (PIC)";
            picText.textContent = details.nama || '-';
            prodiLabel.textContent = "Penyelenggara / Unit";
            prodiText.textContent = details.prodi || '-';
        }

        // Sender Info
        document.getElementById('detail-sender-text').textContent = `${details.nama} (${details.nim})`;

        // WhatsApp Link
        const whatsappBtn = document.getElementById('detail-whatsapp-btn');
        if (details.whatsapp) {
            whatsappBtn.href = `https://wa.me/${details.whatsapp.replace(/\D/g, '')}`;
            whatsappBtn.classList.remove('hidden');
        } else {
            whatsappBtn.classList.add('hidden');
        }

        // Animate modal entry
        modal.classList.remove('pointer-events-none', 'opacity-0');
        modal.classList.add('opacity-100');
        backdrop.classList.replace('opacity-0', 'opacity-100');

        setTimeout(() => {
            content.classList.replace('scale-95', 'scale-100');
            content.classList.replace('opacity-0', 'opacity-100');
        }, 50);
    }

    function closeBookingDetailModal() {
        const modal = document.getElementById('booking-detail-modal');
        const backdrop = document.getElementById('booking-detail-modal-backdrop');
        const content = document.getElementById('booking-detail-modal-content');

        content.classList.replace('scale-100', 'scale-95');
        content.classList.replace('opacity-100', 'opacity-0');
        backdrop.classList.replace('opacity-100', 'opacity-0');

        setTimeout(() => {
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }, 300);
    }
</script>
