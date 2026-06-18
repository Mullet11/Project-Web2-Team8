<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Smart Class Booking')</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets (Global CSS and JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Page Specific Styles -->
    @yield('styles')
</head>
<body class="bg-bg-base text-slate-800 font-sans min-h-screen antialiased flex">

    <!-- ==================== SIDEBAR LAYOUT ==================== -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-100 flex flex-col justify-between z-30 transition-transform duration-300 -translate-x-full lg:translate-x-0">
        
        <!-- Top Section: Brand Logo -->
        <div class="p-6">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-2xl bg-blue-600/10 flex items-center justify-center text-blue-600 group-hover:scale-105 transition-all">
                    <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-extrabold tracking-tight text-slate-900 leading-tight">SmartClass</span>
                    <span class="text-[10px] text-slate-400 font-bold tracking-wider uppercase leading-none mt-0.5">Booking App</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="mt-10 space-y-1.5">
                <!-- Dashboard Menu -->
                <a href="/dashboard" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all duration-200 group {{ Request::is('dashboard*') ? 'bg-blue-600 text-white' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- History Menu -->
                <a href="/history" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all duration-200 group {{ Request::is('history*') ? 'bg-blue-600 text-white' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>History</span>
                </a>

                <!-- Profile Menu -->
                <a href="/profile" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all duration-200 group {{ Request::is('profile*') ? 'bg-blue-600 text-white' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profile</span>
                </a>

            </nav>
        </div>

        <!-- Bottom Section: Settings & Logout -->
        <div class="p-6 border-t border-slate-100/80 space-y-1">
            <!-- Settings Menu -->
            <a href="/settings" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold transition-all duration-200 group {{ Request::is('settings*') ? 'bg-blue-600 text-white' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Pengaturan</span>
            </a>

            <!-- Logout Menu -->
            <a href="/logout" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-sm font-bold text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <!-- Overlay Background when Sidebar Mobile is Open -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-20 hidden lg:hidden"></div>

    <!-- Floating Mobile Sidebar Toggle (Only visible on mobile/tablet screens) -->
    <button type="button" id="mobile-sidebar-toggle" class="fixed top-4 left-4 z-40 bg-white/95 backdrop-blur border border-slate-100 text-slate-500 hover:text-slate-900 p-2.5 rounded-xl focus:outline-none lg:hidden transition-all">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- ==================== MAIN CONTENT CONTAINER ==================== -->
    <div class="flex-grow min-h-screen lg:pl-64 flex flex-col justify-between @if(request()->has('login')) animate-slide-down @endif">

        <!-- Dynamic Main Content -->
        <main class="flex-grow p-4 sm:p-6 lg:p-8 pt-20 lg:pt-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-100 py-6 px-4 sm:px-6 lg:px-8 text-center text-slate-400 text-xs font-semibold">
            <p>&copy; {{ date('Y') }} SmartClass Booking. Kelompok 8.</p>
        </footer>

    </div>

    <!-- Modals Stack (Renders modals at root body level) -->
    @stack('modals')

    <!-- Page Specific Scripts -->
    @yield('scripts')
</body>
</html>
