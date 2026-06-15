<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna | Smart Class Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F8FAFC] min-h-screen p-6 flex flex-col font-['Inter'] antialiased">

    

    <!-- Main Container Card -->
    <div class="flex-1 bg-white rounded-[24px] shadow-sm border border-slate-100 overflow-hidden flex flex-col w-full">
        
        <!-- Content Area -->
        <div class="p-8 md:p-12 flex flex-col gap-10 max-w-[1200px] w-full mx-auto">
            
            <!-- Header Row: Back button and Title -->
            <div class="flex items-center gap-6">
                <!-- Back Button (Yellow Circle) -->
                <a href="<?= base_url('dashboard') ?>" class="w-12 h-12 bg-[#FFB800] hover:bg-[#e0a400] text-white rounded-full flex items-center justify-center transition-all shadow-sm active:scale-95">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                
                <!-- Page Title -->
                <h2 class="text-[32px] font-bold text-[#FFB800] leading-none">Profil</h2>
            </div>

            <!-- Duolingo Style Profile Card (Simplified) -->
            <?php 
            $user_nama = $user['nama'] ?? 'Naufal Khalish';
            $user_nim = $user['nim'] ?? '2205551001';
            $user_prodi = $user['prodi'] ?? 'Teknologi Informasi';
            $user_jenis_kelamin = $user['jenis_kelamin'] ?? 'Laki-laki';
            $user_whatsapp = $user['whatsapp'] ?? '081234567890';
            ?>
            <div class="max-w-[600px] w-full mx-auto bg-white rounded-[32px] overflow-hidden shadow-lg border border-slate-100 my-6">
                
                <!-- Top Yellow Banner -->
                <div class="h-52 bg-[#FFB800] relative flex items-end justify-center pb-4">
                    <!-- Profile Image from Asset (Overlapping bottom boundary) -->
                    <div class="w-32 h-32 rounded-full overflow-hidden bg-white border-4 border-white shadow-md mb-[-32px] z-10 flex items-center justify-center">
                        <img src="<?= base_url('asset/image/ilustrasi.png') ?>" alt="Profile Picture" class="w-full h-full object-contain p-2">
                    </div>
                </div>

                <!-- Bottom Content Area -->
                <div class="pt-12 p-8 flex flex-col items-center text-center bg-white">
                    <!-- Name -->
                    <h3 class="text-2xl font-bold text-slate-800 leading-tight"><?= esc($user_nama) ?></h3>
                    
                    <!-- Details List -->
                    <div class="mt-6 space-y-1.5 text-slate-500 text-sm font-semibold w-full max-w-[380px] text-left mx-auto">
                        <!-- NIM -->
                        <div class="flex items-center gap-3 py-2 border-b border-slate-100">
                            <svg class="w-4 h-4 text-[#FFB800] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                            <span class="text-slate-700">NIM: <span class="text-slate-500 font-medium"><?= esc($user_nim) ?></span></span>
                        </div>
                        <!-- Prodi -->
                        <div class="flex items-center gap-3 py-2 border-b border-slate-100">
                            <svg class="w-4 h-4 text-[#FFB800] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                            <span class="text-slate-700">Prodi: <span class="text-slate-500 font-medium"><?= esc($user_prodi) ?></span></span>
                        </div>
                        <!-- Jenis Kelamin -->
                        <div class="flex items-center gap-3 py-2 border-b border-slate-100">
                            <svg class="w-4 h-4 text-[#FFB800] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                            <span class="text-slate-700">Jenis Kelamin: <span class="text-slate-500 font-medium"><?= esc($user_jenis_kelamin) ?></span></span>
                        </div>
                        <!-- WhatsApp -->
                        <div class="flex items-center gap-3 py-2">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.045 15.045 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1A11.36 11.36 0 018.82 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.62c0-.55-.45-1-1-1z"/>
                            </svg>
                            <span class="text-slate-700">No. WA: <span class="text-slate-500 font-medium"><?= esc($user_whatsapp) ?></span></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>
</html>
