<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pemesanan Lapangan') }}</title>

    {{-- Link ke Tailwind CSS dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Link untuk Ikon (Font Awesome) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Link untuk Ikon (Font Awesome) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Animate On Scroll (AOS) CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />


    {{-- Link untuk Font --}}
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    {{-- Alpine.js untuk interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Animate On Scroll (AOS) CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />


    {{-- Konfigurasi warna custom untuk Tailwind --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'theme-pink': '#f26682',
                        'theme-pink-light': '#fed0e7',
                        'theme-pink-dark': '#ea3766',
                    },
                    // Tambahkan font family di sini agar dikenali Tailwind
                    fontFamily: {
                        'sans': ['Lato', 'sans-serif'],
                        'serif': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    {{-- Style tambahan --}}
    <style>
        /* Ganti font-family body agar sesuai dengan yang di-load */
        body { font-family: 'Lato', sans-serif; }
        .nav-link-active {
            background-color: #fed0e7 !important;
            color: #ea3766 !important;
            border: 2px solid #fff !important;
            font-weight: bold;
        }
        .nav-link-active:hover {
            background-color: #fef3f8 !important;
            border-color: #ea3766 !important;
        }
    </style>
</head>
<body x-data="{ authModalOpen: false }" class="bg-gray-100 antialiased flex flex-col min-h-screen">

    {{-- ========================================================== --}}
    {{-- HEADER UTAMA YANG SUDAH DIMODIFIKASI --}}
    {{-- ========================================================== --}}
    {{-- 1. State 'scrolled' ditambahkan ke x-data. Event scroll ditambahkan ke x-on --}}
    @if(View::hasSection('is_hero_page'))
        {{-- ## JIKA INI HALAMAN HERO (LANDING/DASHBOARD), GUNAKAN HEADER DINAMIS TRANSPARAN ## --}}
        {{--
    File: resources/views/layouts/tailwind.blade.php
    Deskripsi: Perbaikan logika header untuk menghilangkan spasi putih.
--}}

{{-- ========================================================== --}}
{{-- HEADER BARU YANG SUDAH DISATUKAN --}}
{{-- ========================================================== --}}
@php
    // Tentukan jenis halaman di sini agar mudah dibaca
    $isHeroPage = View::hasSection('is_hero_page');
@endphp

<header
        x-data="{ mobileMenuOpen: false, scrolled: false }"
        x-on:scroll.window="scrolled = (window.scrollY > 50)"
        class="w-full z-40 fixed top-0 transition-colors duration-300"
        :class="{ 'bg-theme-pink shadow-lg': scrolled || !{{ $isHeroPage ? 'true' : 'false' }}, 'bg-transparent': !scrolled && {{ $isHeroPage ? 'true' : 'false' }} }"
    >
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between p-1 relative">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="@if($isHeroPage) absolute left-4 top-1/2 -translate-y-1/2 z-20 @endif">
                    <img src="{{ asset('images/logo.png') }}" alt="Zukira Booking Logo" class="h-16 md:h-20 w-auto">
                </a>

                {{-- Navigasi Desktop (tidak ada perubahan di sini) --}}
                <nav class="hidden md:flex items-center space-x-2 w-full justify-end @if($isHeroPage) ml-24 @endif text-white">
                    @auth
                        <a href="/dashboard" class="px-3 py-2 rounded-lg transition {{ request()->is('dashboard') ? 'nav-link-active' : '' }}" :class="scrolled || !{{ $isHeroPage ? 'true' : 'false' }} ? 'hover:bg-white/20' : 'hover:bg-black/10'"><i class="fa fa-home me-1"></i> Dashboard</a>
                        <a href="{{ route('booking.riwayat') }}" class="px-3 py-2 rounded-lg transition {{ request()->is('riwayat-booking') ? 'nav-link-active' : '' }}" :class="scrolled || !{{ $isHeroPage ? 'true' : 'false' }} ? 'hover:bg-white/20' : 'hover:bg-black/10'"><i class="fa fa-calendar-check me-1"></i> Riwayat</a>
                        <a href="/lapangan" class="px-3 py-2 rounded-lg transition {{ request()->is('lapangan*') ? 'nav-link-active' : '' }}" :class="scrolled || !{{ $isHeroPage ? 'true' : 'false' }} ? 'hover:bg-white/20' : 'hover:bg-black/10'"><i class="fa fa-futbol me-1"></i> Lapangan</a>
                        <a href="/review" class="px-3 py-2 rounded-lg transition {{ request()->is('review*') ? 'nav-link-active' : '' }}" :class="scrolled || !{{ $isHeroPage ? 'true' : 'false' }} ? 'hover:bg-white/20' : 'hover:bg-black/10'"><i class="fa fa-star me-1"></i> Review</a>
                    @endauth
                    @guest
                        <button @click="authModalOpen = true" class="px-4 py-2 rounded-lg transition" :class="scrolled || !{{ $isHeroPage ? 'true' : 'false' }} ? 'hover:bg-white/20' : 'hover:bg-black/10'">Login</button>
                        <button @click="authModalOpen = true" class="px-4 py-2 bg-white text-theme-pink-dark font-bold rounded-lg transition hover:bg-pink-100">Register</button>
                    @endguest
                    @auth
                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" class="bg-black/20 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-white/50">
                                <img src="{{ asset('images/user.png') }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 text-gray-800">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100"><i class="fa fa-user fa-fw mr-2"></i>Profile</a>
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm hover:bg-gray-100"><i class="fa fa-sign-out-alt fa-fw mr-2"></i>Logout</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </nav>
                {{-- Tombol Menu Mobile --}}
                <div class="md:hidden ml-auto">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="focus:outline-none text-white"><i class="fas fa-bars text-2xl"></i></button>
                </div>
            </div>
        </div>
    </header>

    @else
        {{-- ## JIKA INI HALAMAN BIASA, GUNAKAN HEADER STANDAR YANG SOLID ## --}}
        <header class="bg-theme-pink text-white shadow-lg sticky top-0 z-40">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between p-1">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Zukira Booking Logo" class="h-16 w-auto">
                    </a>
                    <nav class="hidden md:flex items-center space-x-2">
                        @auth
                            <a href="/dashboard" class="px-3 py-2 rounded-lg transition {{ request()->is('dashboard') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-home me-1"></i> Dashboard</a>
                            <a href="{{ route('booking.riwayat') }}" class="px-3 py-2 rounded-lg transition {{ request()->is('riwayat-booking') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-calendar-check me-1"></i> Riwayat</a>
                            <a href="/lapangan" class="px-3 py-2 rounded-lg transition {{ request()->is('lapangan*') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-futbol me-1"></i> Lapangan</a>
                            <a href="/review" class="px-3 py-2 rounded-lg transition {{ request()->is('review*') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-star me-1"></i> Review</a>
                        @endauth
                          @guest
                            <button @click="authModalOpen = true" class="px-4 py-2 rounded-lg transition hover:bg-white/20">Login</button>
                            <button @click="authModalOpen = true" class="px-4 py-2 bg-white text-theme-pink-dark font-bold rounded-lg transition hover:bg-pink-100">Register</button>
                        @endguest
                         @auth
                            <div x-data="{ dropdownOpen: false }" class="relative">
                                <button @click="dropdownOpen = !dropdownOpen" class="bg-white/20 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-white/50">
                                    <img src="{{ asset('images/user.png') }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                                </button>
                                <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 text-gray-800">
                                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100"><i class="fa fa-user fa-fw mr-2"></i>Profile</a>
                                    <div class="border-t border-gray-200"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm hover:bg-gray-100"><i class="fa fa-sign-out-alt fa-fw mr-2"></i>Logout</button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>
    @endif

    {{-- Konten Utama --}}
    {{-- Penting: Konten di halaman lain (misal: dashboard) harus dimulai dengan elemen
         yang memiliki tinggi, seperti hero section, agar tidak tertutup header. --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer Utama --}}
    <footer class="bg-theme-pink text-white mt-auto">
        {{-- ... kode footer Anda (tidak ada perubahan) ... --}}
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">Menu Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="/dashboard" class="hover:text-pink-200 transition">Dashboard</a></li>
                        <li><a href="{{ route('booking.create') }}" class="hover:text-pink-200 transition">Booking Lapangan</a></li>
                        <li><a href="{{ route('review.create') }}" class="hover:text-pink-200 transition">Tulis Review</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Ikuti Kami</h3>
                    <div class="space-y-2">
                        <a href="#" class="flex items-center hover:text-pink-200 transition"><i class="fab fa-youtube w-6 mr-2"></i> Youtube</a>
                        <a href="#" class="flex items-center hover:text-pink-200 transition"><i class="fab fa-instagram w-6 mr-2"></i> Instagram</a>
                        <a href="#" class="flex items-center hover:text-pink-200 transition" target="_blank"><i class="fab fa-whatsapp w-6 mr-2"></i> WhatsApp</a>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Hubungi Kami</h3>
                    <form action="#" method="POST">
                        <div class="mb-2">
                            <input type="email" name="email" class="w-full px-3 py-2 rounded bg-white/20 placeholder-pink-200 text-white focus:outline-none focus:ring-2 focus:ring-white" placeholder="Email Anda">
                        </div>
                        <div class="mb-2">
                            <textarea name="pesan" rows="2" class="w-full px-3 py-2 rounded bg-white/20 placeholder-pink-200 text-white focus:outline-none focus:ring-2 focus:ring-white" placeholder="Pesan"></textarea>
                        </div>
                        <button class="w-full bg-white text-theme-pink-dark font-bold py-2 px-4 rounded hover:bg-pink-100 transition" type="submit">Kirim</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-pink-400 mt-8 pt-4 text-center text-sm">
                © {{ date('Y') }} Zukira Booking Lapangan | Dibuat dengan ❤️ di Padang
            </div>
        </div>
    </footer>

    {{-- Memanggil Partial Popup --}}
    @include('partials._popup_auth_slider')

    {{-- Script JavaScript dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Animate On Scroll (AOS) JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>


</body>
</html>
