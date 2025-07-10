@extends('layouts.tailwind')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-pink-50 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-rose-400 to-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-pink-400 to-rose-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-60 h-60 bg-gradient-to-br from-rose-400 to-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse animation-delay-4000"></div>
    </div>

    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header with Glassmorphism Effect -->
        <div class="text-center mb-12 transform hover:scale-105 transition-transform duration-300">
            <h1 class="text-5xl font-black bg-gradient-to-r from-rose-600 via-pink-600 to-rose-500 bg-clip-text text-transparent mb-4 tracking-tight">
                Profil Saya
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-rose-500 to-pink-500 mx-auto rounded-full"></div>
        </div>

        <!-- Main Profile Card -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-500 hover:shadow-pink-500/25">
                <!-- Profile Header with Gradient Background -->
                <div class="relative bg-gradient-to-r from-rose-600 via-pink-600 to-rose-500 px-8 py-12">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10">
                        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                            <!-- Profile Picture with Animated Ring -->
                            <div class="relative group">
                                <div class="absolute -inset-4 bg-gradient-to-r from-rose-400 to-pink-400 rounded-full blur opacity-60 group-hover:opacity-100 animate-pulse"></div>
                                <div class="relative">
                                    <img class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-2xl ..." 
                                        src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/user.png') }}" 
                                        alt="Foto Profil">
                                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white shadow-lg animate-bounce"></div>
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="text-center md:text-left text-white">
                                <h2 class="text-4xl font-bold mb-2 transform hover:scale-105 transition-transform duration-300">
                                    {{ $user->name }}
                                </h2>
                                <p class="text-xl text-white/90 mb-4">{{ $user->email }}</p>
                                <div class="flex items-center justify-center md:justify-start space-x-4">
                                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold border border-white/30 capitalize">
                                        {{ $user->role }}
                                    </span>
                                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold border border-white/30">
                                        Member sejak {{ $user->created_at->isoFormat('YYYY') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative Elements -->
                    <div class="absolute top-4 right-4 w-20 h-20 border-2 border-white/20 rounded-full animate-spin-slow"></div>
                    <div class="absolute bottom-4 left-4 w-16 h-16 border-2 border-white/20 rounded-full animate-ping"></div>
                </div>

                <!-- Profile Details -->
                <div class="p-8 space-y-8">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-pink-50 to-rose-100 rounded-2xl p-6 border border-pink-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-pink-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status Akun</p>
                                    <p class="text-lg font-bold text-gray-900">Aktif</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-pink-50 to-rose-100 rounded-2xl p-6 border border-pink-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-pink-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Bergabung</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $user->created_at->isoFormat('D MMM YY') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-pink-50 to-rose-100 rounded-2xl p-6 border border-pink-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-pink-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Peran</p>
                                    <p class="text-lg font-bold text-gray-900 capitalize">{{ $user->role }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                        <a href="{{ route('profile.edit') }}" class="flex-1 group relative overflow-hidden bg-gradient-to-r from-rose-600 to-pink-600 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 hover:shadow-2xl hover:shadow-pink-500/25 transform hover:-translate-y-1">
                            <span class="absolute inset-0 bg-gradient-to-r from-rose-700 to-pink-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            <span class="relative flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                <span>Edit Profil</span>
                            </span>
                        </a>

                        <a href="{{ route('password.change') }}" class="flex-1 group relative overflow-hidden bg-white border-2 border-gray-300 text-gray-700 font-bold py-4 px-8 rounded-2xl transition-all duration-300 hover:border-pink-500 hover:bg-pink-50 transform hover:-translate-y-1">
                            <span class="relative flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v-2L4.257 10.257a6 6 0 018.486-8.486L15 7z"></path></svg>
                                <span>Ubah Password</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    
    h2 {
        font-size: 2rem;
    }
}
</style>
@endsection
