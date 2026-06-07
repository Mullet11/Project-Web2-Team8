<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Smart Class Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden bg-white antialiased font-['Nunito']">

<div class="flex h-screen p-4 md:p-6 gap-6">


    <div class="flex flex-col w-full lg:w-[55%] bg-white relative z-20 border border-gray-100 rounded-[40px] overflow-hidden shadow-sm">


        <div class="p-8 md:p-12 pb-0">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-[#F48200] rounded-2xl flex items-center justify-center shadow-lg text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <span class="text-2xl font-900 text-[#F48200] tracking-tight uppercase font-black">Smart Class</span>
            </div>
        </div>


        <div class="flex-1 flex items-center justify-center px-8 md:px-16">
            <div class="max-w-lg w-full">
                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-5xl font-900 text-[#F48200] mb-4 tracking-tighter leading-tight font-black">Selamat Datang</h1>
                    <p class="text-[#F6BB0A] font-bold text-xl opacity-80 leading-relaxed">Masuk dengan akun resmi kampus Anda.</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-800 text-[#F48200] mb-2 ml-1 uppercase font-black tracking-widest">NIM / NIDN</label>
                        <input type="text" name="username" placeholder="Masukkan ID resmi Anda" class="w-full bg-[#FDE88D]/10 font-bold text-lg border-2 border-[#FBE551]/30 rounded-2xl p-5 focus:outline-none focus:border-[#F48200] focus:bg-white transition-all shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-800 text-[#F48200] mb-2 ml-1 uppercase font-black tracking-widest">Kata Sandi</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full bg-[#FDE88D]/10 font-bold text-lg border-2 border-[#FBE551]/30 rounded-2xl p-5 focus:outline-none focus:border-[#F48200] focus:bg-white transition-all shadow-sm">
                    </div>

                    <div class="flex items-center justify-between px-1">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="w-6 h-6 accent-[#F48200] rounded-lg border-2 border-[#FBE551]">
                            <span class="text-md font-bold text-[#F6BB0A] group-hover:text-[#F48200]">Ingat Saya</span>
                        </label>
                        <a href="#" class="text-sm font-black text-[#F48200] hover:underline uppercase tracking-tighter font-black">Lupa Password?</a>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-[#F48200] text-white py-5 rounded-2xl text-xl font-black shadow-xl hover:bg-[#F6BB0A] transform active:scale-[0.98] transition-all uppercase tracking-widest">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="p-8 md:p-12 pt-0">

        </div>
    </div>


    <div class="hidden lg:flex lg:w-[45%] h-full relative overflow-hidden rounded-[40px] group">
        <img src="<?= base_url('asset/image/loginIllustration.jpg') ?>"
             alt="ULM Illustration"
             class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">



    </div>

</div>

</body>
</html>