<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Pemesanan Lapangan') }}</title>

    {{-- Link ke Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Link untuk Ikon (Font Awesome) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Link untuk Font 'Inter' --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Alpine.js untuk interaktivitas menu dropdown --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Menambahkan warna custom pink agar mudah digunakan di seluruh situs
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'theme-pink': '#f26682', // Kode warna pink dari header Anda
                        'theme-pink-light': '#fed0e7',
                        'theme-pink-dark': '#ea3766',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Style untuk active link agar lebih mirip dengan desain Bootstrap Anda */
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
<body class="bg-gray-100 antialiased flex flex-col min-h-screen">

    {{-- ================================================== --}}
    {{-- HEADER --}}
    {{-- ================================================== --}}
    <header x-data="{ mobileMenuOpen: false }" class="bg-theme-pink text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="text-2xl font-bold">
                    Zukira Booking
                </a>

                {{-- Navigasi Menu (Desktop) --}}
                <nav class="hidden md:flex items-center space-x-2">
                    <a href="/dashboard" class="px-3 py-2 rounded-lg transition {{ request()->is('dashboard') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-home me-1"></i> Dashboard</a>
                    <a href="/booking" class="px-3 py-2 rounded-lg transition {{ request()->is('booking*') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-calendar-check me-1"></i> Riwayat</a>
                    <a href="/lapangan" class="px-3 py-2 rounded-lg transition {{ request()->is('lapangan*') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-futbol me-1"></i> Lapangan</a>
                    <a href="/review" class="px-3 py-2 rounded-lg transition {{ request()->is('review*') ? 'nav-link-active' : 'hover:bg-white/20' }}"><i class="fa fa-star me-1"></i> Review</a>
                    
                    @if(Auth::check())
                        <!-- Profile Dropdown -->
                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" class="bg-white/20 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-white/50">
                                <img src="{{ asset('images/user.png') }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                            </button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 text-gray-800">
                                @if(Auth::user()->role === 'admin')
                                <a href="/admin" class="block px-4 py-2 text-sm hover:bg-gray-100"><i class="fa fa-cogs fa-fw mr-2"></i>Admin Panel</a>
                                @endif
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100"><i class="fa fa-user fa-fw mr-2"></i>Profile</a>
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm hover:bg-gray-100" onclick="return confirm('Anda yakin ingin logout?')">
                                        <i class="fa fa-sign-out-alt fa-fw mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </nav>

                {{-- Tombol Menu (Mobile) --}}
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" class="md:hidden pb-4">
                <a href="/dashboard" class="block py-2 px-4 text-sm rounded {{ request()->is('dashboard') ? 'bg-white text-theme-pink-dark font-bold' : 'hover:bg-white/20' }}">Dashboard</a>
                <a href="/booking" class="block py-2 px-4 text-sm rounded {{ request()->is('booking*') ? 'bg-white text-theme-pink-dark font-bold' : 'hover:bg-white/20' }}">Riwayat Booking</a>
                <a href="/lapangan" class="block py-2 px-4 text-sm rounded {{ request()->is('lapangan*') ? 'bg-white text-theme-pink-dark font-bold' : 'hover:bg-white/20' }}">Lapangan</a>
                <a href="/review" class="block py-2 px-4 text-sm rounded {{ request()->is('review*') ? 'bg-white text-theme-pink-dark font-bold' : 'hover:bg-white/20' }}">Review Pelanggan</a>
                <div class="border-t border-pink-400 mt-2 pt-2">
                    @if(Auth::check())
                        @if(Auth::user()->role === 'admin')
                        <a href="/admin" class="block py-2 px-4 text-sm rounded hover:bg-white/20">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block py-2 px-4 text-sm rounded hover:bg-white/20" onclick="return confirm('Anda yakin ingin logout?')">Logout</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </header>

    {{-- ================================================== --}}
    {{-- KONTEN UTAMA --}}
    {{-- ================================================== --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- ================================================== --}}
    {{-- FOOTER --}}
    {{-- ================================================== --}}
    <footer class="bg-theme-pink text-white mt-auto">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Kolom 1: Menu Cepat --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Menu Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="/dashboard" class="hover:text-pink-200 transition">Dashboard</a></li>
                        <li><a href="{{ route('booking.create') }}" class="hover:text-pink-200 transition">Booking Lapangan</a></li>
                        <li><a href="{{ route('review.create') }}" class="hover:text-pink-200 transition">Tulis Review</a></li>
                    </ul>
                </div>

                {{-- Kolom 2: Ikuti Kami --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Ikuti Kami</h3>
                    <div class="space-y-2">
                        <a href="https://www.youtube.com/@raidatulzukira7092" class="flex items-center hover:text-pink-200 transition"><i class="fab fa-youtube w-6 mr-2"></i> Youtube</a>
                        <a href="https://www.instagram.com/zukiraaa_" class="flex items-center hover:text-pink-200 transition"><i class="fab fa-instagram w-6 mr-2"></i> Instagram</a>
                        <a href="https://wa.me/6281213007587" class="flex items-center hover:text-pink-200 transition" target="_blank"><i class="fab fa-whatsapp w-6 mr-2"></i> WhatsApp</a>
                    </div>
                </div>

                {{-- Kolom 3: Hubungi Kami --}}
                <div>
                    <h3 class="font-bold text-lg mb-4">Hubungi Kami</h3>
                    <form action="mailto:raidatulzukiraa@gmail.com" method="POST" enctype="text/plain">
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
                &copy; {{ date('Y') }} Zukira Booking Lapangan | Alamat: Padang | Kontak: 08123456789
            </div>
        </div>
    </footer>

</body>
</html>
