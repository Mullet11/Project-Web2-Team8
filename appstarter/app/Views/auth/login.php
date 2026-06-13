<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Smart Class Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden antialiased bg-white">

<div class="flex h-screen">


    <div class="hidden lg:flex lg:w-[60%] bg-[#FDF0E9] relative flex-col p-12">

        <div class="flex items-center gap-3 relative z-10">
            <div class="w-10 h-10 bg-[#F48200] rounded-lg flex items-center justify-center text-white shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <span class="text-xl font-extrabold text-slate-800 uppercase tracking-tight">Smart Class</span>
        </div>


        <div class="flex-1 flex items-center justify-center">

        </div>
    </div>


    <div class="w-full lg:w-[40%] flex items-center justify-center p-8 md:p-20">
        <div class="max-w-md w-full">
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Sign in</h1>
            <p class="text-sm text-slate-500 mb-12">
                If you don't have an account register <br>
                You can <a href="#" class="text-orange-500 font-bold hover:underline">Register here !</a>
            </p>

            <form action="<?= base_url('dashboard') ?>" class="space-y-8">

                <div class="relative">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Email / NIM</label>
                    <div class="absolute left-0 bottom-3 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="text" placeholder="Enter your email address" class="input-line">
                </div>


                <div class="relative">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Password</label>
                    <div class="absolute left-0 bottom-3 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="password" placeholder="Enter your Password" class="input-line">
                    <div class="absolute right-0 bottom-3 text-slate-300 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 border-slate-300 rounded text-orange-500 focus:ring-orange-500">
                        <span class="text-xs text-slate-400 font-medium">Remember me</span>
                    </label>
                    <a href="#" class="text-xs text-slate-400 font-medium hover:text-slate-600">Forgot Password ?</a>
                </div>

                <button type="submit" class="w-full btn-pill uppercase tracking-widest text-sm">
                    Login
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>