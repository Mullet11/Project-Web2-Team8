<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Smart Class Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden antialiased bg-white flex flex-col font-['Inter']">

    <!-- Top Left Header -->
    <div class="p-6 text-[14px] text-slate-400 font-medium self-start">
        Sign Up
    </div>

    <!-- Main Content Container -->
    <div class="flex-1 flex items-center justify-center -mt-12">
        <div class="w-full max-w-[500px] px-8 py-10 flex flex-col items-center">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-[34px] font-bold text-[#FFB800] tracking-wide mb-2">Welcome to SIMARI</h1>
                <p class="text-[13px] md:text-sm text-slate-400 font-medium">Enter your details to access your account</p>
            </div>

            <!-- Form Section -->
            <form action="<?= base_url('dashboard') ?>" class="w-full space-y-6">
                <!-- Email Field -->
                <div>
                    <label class="block text-slate-900 font-bold text-[15px] mb-2.5">Email</label>
                    <input type="text" placeholder="Enter Your Email" 
                           class="w-full px-5 py-4 border border-slate-200 rounded-[14px] text-slate-800 placeholder-slate-300 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-[15px]">
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-slate-900 font-bold text-[15px] mb-2.5">Password</label>
                    <input type="password" placeholder="Enter Your Password" 
                           class="w-full px-5 py-4 border border-slate-200 rounded-[14px] text-slate-800 placeholder-slate-300 focus:outline-none focus:border-[#FFB800] focus:ring-1 focus:ring-[#FFB800] transition-all text-[15px]">
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full py-4 bg-[#FFB800] hover:bg-[#e0a400] text-white font-bold text-[16px] rounded-[14px] transition-all active:scale-[0.99] shadow-sm">
                        Register
                    </button>
                </div>

                <!-- Sign In Link -->
                <div class="text-center text-[13px] font-medium text-slate-800 mt-6">
                    Have an account ? <a href="<?= base_url('/') ?>" class="text-[#FFB800] hover:underline font-bold ml-1">Sign in</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
