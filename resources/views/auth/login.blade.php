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
    @vite(['resources/css/app.css', 'resources/css/auth/login.css', 'resources/js/app.js'])

</head>
<body class="bg-white text-slate-800 font-sans min-h-screen antialiased flex">

    <!-- Container Utama: Auto Active jika ada error di registrasi/Sign Up -->
    <div id="auth-container" class="flex-grow flex flex-col lg:flex-row p-4 min-h-screen relative overflow-hidden bg-white @if($errors->has('name') || old('is_signup')) active @endif">
        
        <!-- ==================== LEFT COLUMN: SIGN IN FORM ==================== -->
        <div id="signin-wrapper" class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-12 lg:p-16 h-full min-h-[85vh] lg:min-h-0">
            <!-- Logo Section -->
            <div class="flex items-center gap-2">
                <div class="relative w-8 h-8 flex items-center justify-center">
                    <div class="absolute inset-0 bg-blue-600 rounded-full opacity-20 animate-pulse"></div>
                    <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6 text-blue-600 relative z-10" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">SmartClass</span>
            </div>

            <!-- Sign In Form Box -->
            <div class="my-auto py-8 max-w-sm w-full mx-auto">
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Sign in</h2>
                <p class="text-slate-400 text-sm mb-8 font-medium">Please login to continue to your account.</p>

                <form action="/login" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="is_signup" value="0">

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
                        
                        <button type="button" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path class="eye-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 21l-2-2m-13.875-13.875L3 3" />
                            </svg>
                        </button>
                        @error('password')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer group select-none">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded-md border-slate-300 text-blue-600 focus:ring-blue-600/20 accent-blue-600 cursor-pointer">
                            <span class="ml-3 text-sm font-semibold text-slate-600 group-hover:text-slate-800 transition-colors">Keep me logged in</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                        Sign in
                    </button>
                </form>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                    <div class="relative flex justify-center text-xs font-semibold uppercase"><span class="bg-white px-4 text-slate-400">or</span></div>
                </div>

                <div class="text-center text-sm font-semibold text-slate-500">
                    Need an account? <button type="button" id="go-to-signup" class="text-blue-600 hover:text-blue-700 hover:underline">Create one</button>
                </div>
            </div>

            <div class="text-xs text-slate-400 text-center lg:text-left mt-8">SmartClass Booking &bull; Kelompok 8</div>
        </div>

        <!-- ==================== RIGHT COLUMN: SIGN UP FORM ==================== -->
        <div id="signup-wrapper" class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-12 lg:p-16 h-full min-h-[85vh] lg:min-h-0">
            <!-- Logo Section -->
            <div class="flex items-center gap-2">
                <div class="relative w-8 h-8 flex items-center justify-center">
                    <div class="absolute inset-0 bg-blue-600 rounded-full opacity-20 animate-pulse"></div>
                    <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6 text-blue-600 relative z-10" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">SmartClass</span>
            </div>

            <!-- Sign Up Form Box -->
            <div class="my-auto py-8 max-w-sm w-full mx-auto">
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Sign up</h2>
                <p class="text-slate-400 text-sm mb-8 font-medium">Create a new account to get started.</p>

                <form action="/register" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="is_signup" value="1">

                    <!-- Full Name Floating Input -->
                    <div class="relative">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder=" " 
                            class="block px-4 py-3.5 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('name') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="name" 
                            class="absolute text-sm @error('name') text-rose-500 @else text-slate-400 peer-focus:text-blue-600 @enderror duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            Nama Lengkap
                        </label>
                        @error('name')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIM / NIDN Floating Input -->
                    <div class="relative">
                        <input type="text" id="signup_identity_number" name="identity_number" value="{{ old('identity_number') }}" required placeholder=" " 
                            class="block px-4 py-3.5 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('identity_number') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="signup_identity_number" 
                            class="absolute text-sm @error('identity_number') text-rose-500 @else text-slate-400 peer-focus:text-blue-600 @enderror duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            NIM / NIDN
                        </label>
                        @error('identity_number')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Floating Input -->
                    <div class="relative">
                        <input type="password" id="signup_password" name="password" required placeholder=" " 
                            class="block px-4 py-3.5 pr-12 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('password') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="signup_password" 
                            class="absolute text-sm @error('password') text-rose-500 @else text-slate-400 peer-focus:text-blue-600 @enderror duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            Password
                        </label>
                        
                        <button type="button" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path class="eye-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 21l-2-2m-13.875-13.875L3 3" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                        Create Account
                    </button>
                </form>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                    <div class="relative flex justify-center text-xs font-semibold uppercase"><span class="bg-white px-4 text-slate-400">or</span></div>
                </div>

                <div class="text-center text-sm font-semibold text-slate-500">
                    Already have an account? <button type="button" id="go-to-signin" class="text-blue-600 hover:text-blue-700 hover:underline">Sign in</button>
                </div>
            </div>

            <div class="text-xs text-slate-400 text-center lg:text-left mt-8">SmartClass Booking &bull; Kelompok 8</div>
        </div>

        <!-- ==================== ABSOLUTE FLOATING IMAGE CARD (Desktop Only) ==================== -->
        <div id="sliding-card" class="hidden lg:block absolute top-4 bottom-4 w-[42%] rounded-[32px] bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-900 shadow-2xl overflow-hidden z-20">
            <!-- Abstract Glass Circle Overlays -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 left-0 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl"></div>
            
            <!-- Centered Artwork Label -->
            <div class="w-full h-full flex flex-col justify-end p-12 relative">
                <div class="relative z-10 text-white/40 font-semibold text-sm tracking-widest uppercase">
                    [ Area Gambar / Artwork Placeholder ]
                </div>
            </div>
        </div>

    </div>

</body>
</html>
