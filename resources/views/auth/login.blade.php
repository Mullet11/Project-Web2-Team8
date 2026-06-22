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
<body class="bg-white text-slate-800 font-sans min-h-screen lg:h-screen lg:overflow-hidden antialiased flex">

    <!-- Container Utama: Auto Active jika ada error di registrasi/Sign Up atau baru register -->
    <div id="auth-container" class="flex-grow flex flex-col lg:flex-row p-4 min-h-screen lg:h-full lg:min-h-0 relative overflow-hidden bg-white @if($errors->has('name') || old('is_signup') || request()->has('registered') || isset($is_signup)) active @endif">
        
        <!-- ==================== LEFT COLUMN: SIGN IN FORM ==================== -->
        <div id="signin-wrapper" class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-12 lg:p-16 h-full min-h-[85vh] lg:min-h-0 lg:overflow-y-auto">
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

                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all duration-200">
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
        <div id="signup-wrapper" class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-12 lg:p-16 h-full min-h-[85vh] lg:min-h-0 lg:overflow-y-auto">
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

                    <!-- Email Floating Input -->
                    <div class="relative">
                        <input type="email" id="signup_email" name="email" value="{{ old('email') }}" required placeholder=" " 
                            class="block px-4 py-3.5 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('email') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="signup_email" 
                            class="absolute text-sm @error('email') text-rose-500 @else text-slate-400 peer-focus:text-blue-600 @enderror duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            Email (wajib @mhs.ulm.ac.id atau @ulm.ac.id)
                        </label>
                        @error('email')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- WhatsApp Floating Input -->
                    <div class="relative">
                        <input type="tel" id="signup_whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" required placeholder=" " 
                            class="block px-4 py-3.5 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('whatsapp') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="signup_whatsapp" 
                            class="absolute text-sm @error('whatsapp') text-rose-500 @else text-slate-400 peer-focus:text-blue-600 @enderror duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            Nomor WhatsApp Aktif
                        </label>
                        @error('whatsapp')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fakultas Dropdown -->
                    <div class="relative">
                        <select id="signup_fakultas" name="faculty" required
                            class="block px-4 py-3.5 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('faculty') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all cursor-pointer pr-10">
                            <option value="" disabled selected>Pilih Fakultas</option>
                            <option value="Teknik" {{ old('faculty') == 'Teknik' ? 'selected' : '' }}>Fakultas Teknik</option>
                        </select>
                        <label for="signup_fakultas" 
                            class="absolute text-sm text-slate-400 peer-focus:text-blue-600 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 left-3 select-none pointer-events-none">
                            Fakultas
                        </label>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('faculty')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror

                    <!-- Program Studi Dropdown -->
                    <div class="relative">
                        <select id="signup_prodi" name="study_program" required disabled
                            class="block px-4 py-3.5 w-full text-sm text-slate-900 bg-transparent rounded-xl border @error('study_program') border-rose-500 focus:border-rose-500 @else border-slate-200 focus:border-blue-600 @enderror appearance-none focus:outline-none focus:ring-0 peer transition-all cursor-pointer pr-10 disabled:opacity-60 disabled:cursor-not-allowed">
                            <option value="" disabled selected>Pilih Program Studi</option>
                        </select>
                        <label for="signup_prodi" 
                            class="absolute text-sm text-slate-400 peer-focus:text-blue-600 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 left-3 select-none pointer-events-none">
                            Program Studi
                        </label>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('study_program')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror

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
                        @error('password')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Floating Input -->
                    <div class="relative">
                        <input type="password" id="signup_password_confirmation" name="password_confirmation" required placeholder=" " 
                            class="block px-4 py-3.5 pr-12 w-full text-sm text-slate-900 bg-transparent rounded-xl border border-slate-200 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer transition-all" />
                        <label for="signup_password_confirmation" 
                            class="absolute text-sm text-slate-400 peer-focus:text-blue-600 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3 select-none pointer-events-none">
                            Konfirmasi Password
                        </label>
                        
                        <button type="button" class="toggle-password absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 eye-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path class="eye-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 21l-2-2m-13.875-13.875L3 3" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all duration-200">
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
        <div id="sliding-card" class="hidden lg:block absolute top-4 bottom-4 w-[42%] rounded-[32px] bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-900 overflow-hidden z-20">
            
            <!-- Background Animation GIF -->
            <img src="{{ asset('video/giflogin.gif') }}" class="absolute inset-0 w-full h-full object-cover" alt="Auth Background Animation">

            <!-- Premium Dark Gradient Overlay (Menjaga agar teks di atasnya tetap terbaca) -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent z-10"></div>

            <!-- Abstract Glass Circle Overlays -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl z-10"></div>
            <div class="absolute bottom-1/4 left-0 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl z-10"></div>
        </div>

    </div>

    <!-- Floating Success Toast -->
    <div id="success-toast" class="fixed top-6 left-1/2 -translate-x-1/2 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-500 pointer-events-none">
        <div class="bg-emerald-500 text-white px-6 py-3.5 rounded-2xl flex items-center gap-3 border border-emerald-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-bold tracking-tight">Registrasi Berhasil! Mengalihkan ke masuk...</span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fakultasSelect = document.getElementById('signup_fakultas');
            const prodiSelect = document.getElementById('signup_prodi');

            const prodiList = {
                'Teknik': [
                    'Teknik Sipil',
                    'Teknik Arsitektur',
                    'Teknik Pertambangan',
                    'Teknik Kimia',
                    'Teknik Lingkungan',
                    'Teknik Mesin',
                    'Teknologi Informasi',
                    'Teknik Geologi',
                    'Rekayasa Elektro',
                    'Rekayasa Sistem Komputer'
                ]
            };

            fakultasSelect.addEventListener('change', () => {
                const selectedFakultas = fakultasSelect.value;
                prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';
                
                if (prodiList[selectedFakultas]) {
                    prodiSelect.disabled = false;
                    prodiList[selectedFakultas].forEach(prodi => {
                        const option = document.createElement('option');
                        option.value = prodi;
                        option.textContent = prodi;
                        prodiSelect.appendChild(option);
                    });
                } else {
                    prodiSelect.disabled = true;
                }
            });

            // Pre-fill if validation failed and old input exists
            const oldFaculty = "{{ old('faculty') }}";
            const oldStudyProgram = "{{ old('study_program') }}";

            if (oldFaculty) {
                fakultasSelect.value = oldFaculty;
                // Trigger change manually to populate study programs list
                fakultasSelect.dispatchEvent(new Event('change'));
                if (oldStudyProgram) {
                    prodiSelect.value = oldStudyProgram;
                }
            }
        });
    </script>
</body>
</html>
