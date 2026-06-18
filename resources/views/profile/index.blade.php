@extends('layouts.app')
@section('title', 'Profil Saya - Smart Class Booking')
@section('content')
<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Profil Saya</h1>
    <p class="text-sm text-slate-500 mt-1">Kelola informasi pribadi dan keamanan akun Anda.</p>
</div>

@if(session('success'))
    <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="mb-4 bg-rose-100 border border-rose-400 text-rose-700 px-4 py-3 rounded-xl relative">
        <ul>
            @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- ========== CONTENT ========== -->
<div class="grid grid-cols-1 gap-6">
    <!-- Personal Info -->
    <div class="space-y-6">
        <!-- Personal Information Card -->
        <div class="bg-white rounded-[24px] border border-slate-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>

                </div>
                <button type="button" id="toggle-edit-btn" class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-bold rounded-xl transition-all duration-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Profil
                </button>
            </div>

            <form id="profile-form" action="/profile" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Avatar Placeholder - Centered -->
                <div class="flex flex-col items-center py-6 mb-2">
                    <div class="relative group cursor-pointer w-48 h-48" style="width: 200px; height: 200px;">
                        <!-- Circle with photo -->
                        <div class="w-48 h-48 rounded-full ring-4 ring-blue-100 group-hover:ring-blue-200 transition-all overflow-hidden" style="width: 200px; height: 200px;">
                            <img src="{{ asset('images/profile/ULM PNG.png') }}" alt="Foto Profil"
                                class="w-full h-full object-cover">
                        </div>
                        <!-- Camera overlay on hover -->
                        <div class="absolute inset-0 rounded-full bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">

                        </div>

                           </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama Lengkap -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" id="input-name" value="{{ $user->name }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-60 disabled:cursor-not-allowed"
                            disabled>
                    </div>
                    <!-- NIM -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">NIM / NIDN</label>
                        <input type="text" id="input-nim" value="{{ $user->identity_number }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-60 disabled:cursor-not-allowed"
                            disabled>
                    </div>
                    <!-- Email -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Email</label>
                        <input type="email" id="input-email" value="{{ $user->email }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-60 disabled:cursor-not-allowed"
                            disabled>
                    </div>

                    <!-- Password Baru -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Password Baru (Opsional)</label>
                        <input type="password" id="input-password" name="password" placeholder="Biarkan kosong jika tidak diubah"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-60 disabled:cursor-not-allowed"
                            disabled>
                    </div>
                    <!-- Konfirmasi Password -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Konfirmasi Password Baru</label>
                        <input type="password" id="input-password-confirmation" name="password_confirmation" placeholder="Biarkan kosong jika tidak diubah"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:outline-none focus:border-blue-600 focus:bg-white transition-all disabled:opacity-60 disabled:cursor-not-allowed"
                            disabled>
                    </div>
                </div>
                <!-- Save Button (Hidden when not editing) -->
                <div id="save-actions" class="hidden pt-2 flex gap-3">
                    <button type="button" id="cancel-edit-btn" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold rounded-xl transition-all duration-200 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all duration-200 cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggle-edit-btn');
        const cancelBtn = document.getElementById('cancel-edit-btn');
        const saveActions = document.getElementById('save-actions');
        const inputs = document.querySelectorAll('#profile-form input');
        let isEditing = false;
        function enableEdit() {
            isEditing = true;
            inputs.forEach(input => input.removeAttribute('disabled'));
            saveActions.classList.remove('hidden');
            toggleBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batalkan
            `;
        }
        function disableEdit() {
            isEditing = false;
            inputs.forEach(input => input.setAttribute('disabled', true));
            saveActions.classList.add('hidden');
            toggleBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Profil
            `;
        }
        toggleBtn.addEventListener('click', function () {
            if (isEditing) {
                disableEdit();
            } else {
                enableEdit();
            }
        });
        cancelBtn.addEventListener('click', function () {
            disableEdit();
        });
    });
</script>
@endsection
