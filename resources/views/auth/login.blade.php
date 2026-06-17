<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign in - Smart Class Booking</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 font-sans min-h-screen antialiased flex">

    <div class="flex-1 flex flex-col lg:flex-row p-4 min-h-screen">
        <!-- Left Column: Login Form -->
        <div class="w-full lg:w-[50%] flex flex-col justify-between p-6 sm:p-12 lg:p-16">
            
            <!-- Logo Section -->
            <div class="flex items-center gap-2">
                <!-- Geometric Blue Icon (Revolutie Style) -->
                <div class="relative w-8 h-8 flex items-center justify-center">
                    <div class="absolute inset-0 bg-blue-600 rounded-full opacity-20 animate-pulse"></div>
                    <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6 text-blue-600 relative z-10" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">SmartClass</span>
            </div>

            <!-- Main Form Wrapper -->
            <div class="my-auto py-8 max-w-sm w-full mx-auto">
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Sign in</h2>
                <p class="text-slate-400 text-sm mb-8 font-medium">Please login to continue to your account.</p>

                <!-- Login Form -->
                <form action="/login" method="POST" class="space-y-6">
                    @csrf

                    <!-- NIM / NIDN Floating Input -->
                    <div class="relative">
                        <input type="text" id="identity_number" name="identity_number" value="{{ old('identity_number') }}" required placeholder=" " 
                            class="block px-4 py-3.5 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('identity_number') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="identity_number" 
                            class="absolute text-sm @error('identity_number') text-rose-500 @else text-slate-400 peer-focus:text-blue-600 @enderror duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            NIM / NIDN
                        </label>
                        @error('identity_number')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Floating Input -->
                    <div class="relative">
                        <input type="password" id="password" name="password" required placeholder=" " 
                            class="block px-4 py-3.5 pr-12 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('password') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="password" 
                            class="absolute text-sm @error('password') text-rose-500 @else text-slate-400 peer-focus:text-blue-600 @enderror duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            Password
                        </label>
                        
                        <!-- Toggle Password Icon Button -->
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                            <!-- Eye Slash (Hide Password) Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" id="eye-hide" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 21l-2-2m-13.875-13.875L3 3" />
                            </svg>
                            <!-- Eye (Show Password) Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" id="eye-show" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        @error('password')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer group select-none">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded-md border-slate-300 text-blue-600 focus:ring-blue-600/20 accent-blue-600 cursor-pointer">
                            <span class="ml-3 text-sm font-semibold text-slate-600 group-hover:text-slate-800 transition-colors">Keep me logged in</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none">
                        Sign in
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-slate-100"></div>
                    </div>
                    <div class="relative flex justify-center text-xs font-semibold uppercase">
                        <span class="bg-white px-4 text-slate-400">or</span>
                    </div>
                </div>

                <!-- Registration / Create Account Link -->
                <div class="text-center text-sm font-semibold text-slate-500">
                    Need an account? <a href="#" class="text-blue-600 hover:text-blue-700 hover:underline">Create one</a>
                </div>

            </div>

            <!-- Footer Left Column -->
            <div class="text-xs text-slate-400 text-center lg:text-left mt-8">
                SmartClass Booking &bull; Kelompok 8
            </div>
        </div>

        <!-- Right Column: Image Placeholder (Desktop Only) -->
        <div class="hidden lg:flex lg:w-[50%] p-4 justify-end">
            <!-- Placeholder Box with Beautiful Gradient & Rounded Corners -->
            <div class="w-[85%] xl:w-[80%] h-full rounded-[32px] bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-900 flex flex-col justify-end p-12 relative overflow-hidden shadow-2xl">
                <!-- Abstract Glass Circle Overlays -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-1/4 left-0 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl"></div>
                
                <!-- Placeholder Label inside the visual box -->
                <div class="relative z-10 text-white/40 font-semibold text-sm tracking-widest uppercase">
                    [ Area Gambar / Artwork Placeholder ]
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Password Visibility JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const eyeShow = document.getElementById('eye-show');
            const eyeHide = document.getElementById('eye-hide');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', () => {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    eyeShow.classList.toggle('hidden');
                    eyeHide.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
