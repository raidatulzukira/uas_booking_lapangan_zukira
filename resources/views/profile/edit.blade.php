@extends('layouts.tailwind')

@section('title', 'Edit Profil')

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
                Edit Profil
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-rose-500 to-pink-500 mx-auto rounded-full"></div>
        </div>

        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mb-6">
            <a href="{{ route('profile.show') }}" class="inline-flex items-center space-x-2 text-pink-600 hover:text-pink-800 transition-colors group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-semibold">Kembali ke Profil</span>
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="max-w-4xl mx-auto">
             <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-500 hover:shadow-pink-500/25">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-rose-600 via-pink-600 to-rose-500 px-8 py-8">
                    <div class="text-center text-white">
                        <h2 class="text-3xl font-bold mb-2">Perbarui Informasi Profil</h2>
                        <p class="text-white/90">Ubah informasi profil Anda di bawah ini</p>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Profile Picture Section -->
                        <div class="text-center">
                            <div class="relative inline-block group">
                                <div class="absolute -inset-4 bg-gradient-to-r from-rose-400 to-pink-400 rounded-full blur opacity-60 group-hover:opacity-100 transition-opacity"></div>
                                <div class="relative">
                                    <img id="profilePreview" class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-2xl" 
                                        src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/user.png') }}" 
                                        alt="Preview Foto Profil">
                                    <label for="profile_photo" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </label>
                                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden">
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-gray-600">Klik pada foto untuk mengubah gambar profil</p>
                        </div>

                        <!-- Form Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Name Field -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-bold text-gray-700">Nama Lengkap</label>
                                <div class="relative">
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                           class="w-full px-4 py-4 border-2 border-gray-300 rounded-2xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 bg-white/50 backdrop-blur-sm"
                                           placeholder="Masukkan nama lengkap" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-bold text-gray-700">Email</label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                           class="w-full px-4 py-4 border-2 border-gray-300 rounded-2xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 bg-white/50 backdrop-blur-sm"
                                           placeholder="Masukkan email" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="space-y-2">
                                <label for="phone" class="block text-sm font-bold text-gray-700">Nomor Telepon</label>
                                <div class="relative">
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                                           class="w-full px-4 py-4 border-2 border-gray-300 rounded-2xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 bg-white/50 backdrop-blur-sm"
                                           placeholder="Masukkan nomor telepon">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bio Field -->
                            <div class="space-y-2">
                                <label for="bio" class="block text-sm font-bold text-gray-700">Bio</label>
                                <div class="relative">
                                    <textarea id="bio" name="bio" rows="4" 
                                              class="w-full px-4 py-4 border-2 border-gray-300 rounded-2xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 bg-white/50 backdrop-blur-sm resize-none"
                                              placeholder="Ceritakan tentang diri Anda">{{ old('bio', $user->bio ?? '') }}</textarea>
                                </div>
                                @error('bio')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
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
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span>Simpan Perubahan</span>
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
// Preview image before upload
document.getElementById('profile_photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    
    if (!name || !email) {
        e.preventDefault();
        alert('Nama dan email wajib diisi!');
        return;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.innerHTML = `
        <span class="relative flex items-center justify-center space-x-2">
            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Menyimpan...</span>
        </span>
    `;
    submitBtn.disabled = true;
});
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

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Custom hover effects */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

/* Glassmorphism effect enhancement */
.backdrop-blur-xl {
    backdrop-filter: blur(16px);
}

/* Enhanced button hover effects */
button:hover {
    transform: translateY(-2px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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
