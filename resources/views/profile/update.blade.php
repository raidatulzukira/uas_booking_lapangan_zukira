@extends('layouts.tailwind')

@section('title', 'Ubah Password')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-pink-50 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-rose-400 to-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-pink-400 to-rose-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-60 h-60 bg-gradient-to-br from-rose-400 to-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse animation-delay-4000"></div>
    </div>

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-12 transform hover:scale-105 transition-transform duration-300">
            <h1 class="text-5xl font-black bg-gradient-to-r from-rose-600 via-pink-600 to-rose-500 bg-clip-text text-transparent mb-4 tracking-tight">
                Ubah Password
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-rose-500 to-pink-500 mx-auto rounded-full"></div>
        </div>

        <!-- Back Button -->
        <div class="max-w-2xl mx-auto mb-6">
            <a href="{{ route('profile.show') }}" class="inline-flex items-center space-x-2 text-pink-600 hover:text-pink-800 transition-colors group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-semibold">Kembali ke Profil</span>
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="max-w-2xl mx-auto">
           <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-500 hover:shadow-pink-500/25">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-rose-600 via-pink-600 to-rose-500 px-8 py-8">
                    <div class="text-center text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v-2L4.257 10.257a6 6 0 018.486-8.486L15 7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">Keamanan Akun</h2>
                        <p class="text-white/90">Ubah password Anda untuk menjaga keamanan akun</p>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Security Notice -->
                        <div class="bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 rounded-2xl p-4 mb-6">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-pink-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-rose-900 mb-1">Tips Keamanan Password:</h3>
                                    <ul class="text-sm text-rose-800 space-y-1">
                                        <li>• Gunakan minimal 8 karakter</li>
                                        <li>• Kombinasikan huruf besar, kecil, angka, dan simbol</li>
                                        <li>• Hindari menggunakan informasi pribadi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Current Password -->
                        <div class="space-y-2">
                            <label for="current_password" class="block text-sm font-bold text-gray-700">Password Saat Ini</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password" 
                                       class="w-full px-4 py-4 pr-12 border-2 border-gray-300 rounded-2xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 bg-white/50 backdrop-blur-sm"
                                       placeholder="Masukkan password saat ini" required>
                                <button type="button" onclick="togglePassword('current_password')" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-bold text-gray-700">Password Baru</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" 
                                       class="w-full px-4 py-4 pr-12 border-2 border-gray-300 rounded-2xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 bg-white/50 backdrop-blur-sm"
                                       placeholder="Masukkan password baru" required>
                                <button type="button" onclick="togglePassword('password')" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            
                            <!-- Password Strength Indicator -->
                            <div class="mt-2">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs font-medium text-gray-600">Kekuatan Password:</span>
                                    <div class="flex-1 max-w-40">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div id="password-strength" class="h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    <span id="strength-text" class="text-xs font-medium text-gray-500"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                       class="w-full px-4 py-4 pr-12 border-2 border-gray-300 rounded-2xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 bg-white/50 backdrop-blur-sm"
                                       placeholder="Konfirmasi password baru" required>
                                <button type="button" onclick="togglePassword('password_confirmation')" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            
                            <!-- Password Match Indicator -->
                            <div id="password-match" class="hidden mt-2">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-sm text-green-600 font-medium">Password cocok!</span>
                                </div>
                            </div>
                            
                            <div id="password-mismatch" class="hidden mt-2">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    <span class="text-sm text-red-600 font-medium">Password tidak cocok!</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                            <button type="button" onclick="window.history.back()" 
                                    class="flex-1 group relative overflow-hidden bg-white border-2 border-gray-300 text-gray-700 font-bold py-4 px-8 rounded-2xl transition-all duration-300 hover:border-pink-500 hover:bg-pink-50 transform hover:-translate-y-1">
                                <span class="relative flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    <span>Batal</span>
                                </span>
                            </button>

                            <button type="submit" 
                                    class="flex-1 group relative overflow-hidden bg-gradient-to-r from-rose-600 to-pink-600 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 hover:shadow-2xl hover:shadow-pink-500/25 transform hover:-translate-y-1">
                                <span class="absolute inset-0 bg-gradient-to-r from-rose-700 to-pink-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                <span class="relative flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>Ubah Password</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ... (kode JavaScript tidak ada perubahan) ...
</script>

<style>
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Enhanced focus states */
input:focus {
    outline: none;
    border-color: #ec4899; /* Pink focus color */
    box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
}

/* Password visibility button hover */
button:hover svg {
    color: #6b7280;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    h1 {
        font-size: 2.5rem;
    }
}
</style>
@endsection
