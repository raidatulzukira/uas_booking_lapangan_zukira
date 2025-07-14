@section('is_hero_page', true)

@extends('layouts.tailwind')

@section('content')

{{-- ========================================================== --}}
{{-- HERO SECTION --}}
{{-- ========================================================== --}}
<div class="relative w-full min-h-[60vh] md:min-h-[100vh] flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('{{ asset('images/bernabeu.jpg') }}');">
    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></div>
    <div class="relative z-10 p-4">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-5 tracking-wide leading-tight" style="font-family: 'Playfair Display', serif;">
            Selamat Datang
        </h1>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-9 tracking-wide leading-tight" style="font-family: 'Playfair Display', serif;">
            Zukira Booking Lapangan
        </h1>
        <p class="font-family text-md md:text-lg text-gray-200 max-w-2xl mx-auto mb-20">
            Temukan dan pesan lapangan olahraga favorit Anda dengan mudah, cepat, dan aman. Kelola jadwal, lihat riwayat booking, dan nikmati pengalaman bermain yang menyenangkan hanya di Zukira Booking. Siap main hari ini? Yuk, booking lapangan favoritmu langsung dari genggaman tangan, praktis, dan tanpa ribet.
        </p>
        <a href="{{ route('lapangan.index') }}" class="inline-flex items-center gap-3 bg-theme-pink-dark text-white font-bold py-3 px-6 rounded-lg hover:bg-opacity-90 transition-all shadow-md">
            <i class="fa fa-futbol"></i>
            <span>Lihat Semua Lapangan</span>
        </a>
    </div>
</div>

{{-- ============================================================= --}}
{{-- KONTEN UTAMA DENGAN BACKGROUND PINK --}}
{{-- ============================================================= --}}
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

{{-- INI ADALAH PEMBUKA KONTAINER DENGAN GRADIENT PINK --}}
<div class="bg-gradient-to-br from-pink-50 to-pink-100">

    {{-- 1. SEKSI REVIEW --}}
    <div class="container mx-auto px-4 py-8 md:py-12">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p class="font-bold">Sukses</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div>
            <h4 data-aos="fade-up" class="font-serif text-4xl md:text-4xl font-bold text-theme-pink-dark mb-8 text-center">Apa Kata Mereka?</h4>

            @if($reviews->isNotEmpty())
                <div data-aos="fade-up" data-aos-delay="200" class="swiper review-swiper max-w-6xl mx-auto relative">
                    <div class="swiper-wrapper">
                        @foreach($reviews as $review)
                            <div class="swiper-slide pb-10 px-2">
                                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 h-full flex flex-col">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-shrink-0 w-12 h-12 p-1 rounded-full bg-white ring-2 ring-theme-pink-light">
                                            <img src="{{ asset('images/user.png') }}" alt="Foto User" class="w-full h-full rounded-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-base font-semibold text-gray-800">{{ $review->user->name ?? 'Pengguna' }}</div>
                                            <div class="text-sm text-theme-pink-dark font-medium mt-0.5">{{ $review->lapangan->nama }}</div>
                                        </div>
                                    </div>
                                    <p class="mt-4 text-gray-600 text-sm leading-relaxed italic flex-grow">"{{ $review->komentar }}"</p>
                                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                        <div class="text-theme-pink-dark">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star {{ $i <= $review->rating ? '' : 'opacity-30' }}"></i>
                                            @endfor
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                {{-- <div class="swiper-button-next text-theme-pink-dark after:text-2xl"></div>
                <div class="swiper-button-prev text-theme-pink-dark after:text-2xl"></div> --}}

            @else
                <div data-aos="zoom-in" class="text-center text-gray-500 py-8 px-4 rounded-xl bg-white shadow-sm border max-w-2xl mx-auto">
                    Belum ada review yang masuk.
                </div>
            @endif
        </div>
    </div>

    {{-- 2. SEKSI "KENAPA HARUS MEMILIH KAMI" --}}
    <div class="container mx-auto px-4 py-8 md:py-10">
        <div class="max-w-6xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-4xl md:text-4xl font-serif font-bold text-theme-pink-dark mb-6">Kenapa Harus Memilih Kami?</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-md mb-10">
                Kami berkomitmen memberikan layanan terbaik bagi Anda yang ingin memesan lapangan olahraga dengan mudah, cepat, dan nyaman. Kami bukan sekadar tempat booking. Kami hadir dengan:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left px-4 md:px-8">

                {{-- KARTU 1 DIBUNGKUS DENGAN 'group' --}}
                <div class="group" data-aos="zoom-in" data-aos-delay="100">
                    <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-5 shadow-md group-hover:shadow-lg group-hover:-translate-y-2 transition-all duration-300">
                        <div class="text-theme-pink-dark text-3xl mb-4"><i class="fas fa-calendar-check"></i></div>
                        <h3 class="text-lg font-semibold mb-2">Booking Online 24/7</h3>
                        <p class="text-gray-600 text-sm">Anda bisa melakukan pemesanan kapan saja tanpa perlu datang langsung ke lokasi.</p>
                    </div>
                </div>

                {{-- KARTU 2 DIBUNGKUS DENGAN 'group' --}}
                <div class="group" data-aos="zoom-in" data-aos-delay="200">
                    <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-5 shadow-md group-hover:shadow-lg group-hover:-translate-y-2 transition-all duration-300">
                        <div class="text-theme-pink-dark text-3xl mb-4"><i class="fas fa-shield-alt"></i></div>
                        <h3 class="text-lg font-semibold mb-2">Transaksi Aman</h3>
                        <p class="text-gray-600 text-sm">Sistem kami terjamin keamanannya dengan bukti pembayaran dan riwayat lengkap.</p>
                    </div>
                </div>

                {{-- KARTU 3 DIBUNGKUS DENGAN 'group' --}}
                <div class="group" data-aos="zoom-in" data-aos-delay="300">
                    <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-5 shadow-md group-hover:shadow-lg group-hover:-translate-y-2 transition-all duration-300">
                        <div class="text-theme-pink-dark text-3xl mb-4"><i class="fas fa-star"></i></div>
                        <h3 class="text-lg font-semibold mb-2">Rating & Review Jelas</h3>
                        <p class="text-gray-600 text-sm">Lihat pengalaman pengguna lain sebelum memesan, sehingga Anda lebih percaya memilih.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- 3. SEKSI "CARA BOOKING" (DIMODIFIKASI) --}}
    <div class="container mx-auto px-4 py-8 md:py-24">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-theme-pink-dark mb-4" data-aos="fade-up">Booking Lapangan, Semudah Itu!</h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-md mb-10" data-aos="fade-up" data-aos-delay="100">Ikuti 4 langkah sederhana untuk mengamankan jadwal bermain Anda bersama kami.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 px-4 md:px-8">

                {{-- KARTU 1 DIBUNGKUS DENGAN 'group' --}}
                <div class="group" data-aos="fade-down" data-aos-delay="500">
                    <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-6 shadow-md group-hover:shadow-lg group-hover:-translate-y-2 transition-all duration-300 h-full">
                        <div class="mx-auto mb-4 w-24 h-24 flex items-center justify-center rounded-full bg-theme-pink-light text-theme-pink-dark text-4xl shadow-lg ring-4 ring-white"><i class="fas fa-calendar-check"></i></div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">1. Pilih & Booking</h3>
                        <p class="text-gray-600 text-sm px-2">Masuk ke akun Anda, pilih lapangan favorit, lalu tentukan tanggal dan jam bermain yang Anda inginkan.</p>
                    </div>
                </div>

                {{-- KARTU 2 DIBUNGKUS DENGAN 'group' --}}
                <div class="group" data-aos="fade-up" data-aos-delay="500">
                    <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-6 shadow-md group-hover:shadow-lg group-hover:-translate-y-2 transition-all duration-300 h-full">
                        <div class="mx-auto mb-4 w-24 h-24 flex items-center justify-center rounded-full bg-theme-pink-light text-theme-pink-dark text-4xl shadow-lg ring-4 ring-white"><i class="fas fa-credit-card"></i></div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">2. Konfirmasi & Bayar</h3>
                        <p class="text-gray-600 text-sm px-2">Tunggu sebentar hingga admin mengonfirmasi jadwal Anda. Setelah itu, lakukan pembayaran dan unggah buktinya.</p>
                    </div>
                </div>

                {{-- KARTU 3 DIBUNGKUS DENGAN 'group' --}}
                <div class="group" data-aos="fade-down" data-aos-delay="500">
                    <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-6 shadow-md group-hover:shadow-lg group-hover:-translate-y-2 transition-all duration-300 h-full">
                        <div class="mx-auto mb-4 w-24 h-24 flex items-center justify-center rounded-full bg-theme-pink-light text-theme-pink-dark text-4xl shadow-lg ring-4 ring-white"><i class="fas fa-ticket-alt"></i></div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">3. Dapatkan Tiket</h3>
                        <p class="text-gray-600 text-sm px-2">Setelah pembayaran diverifikasi oleh admin, tiket digital dalam bentuk PDF akan tersedia di akun Anda untuk di-download.</p>
                    </div>
                </div>

                {{-- KARTU 4 DIBUNGKUS DENGAN 'group' --}}
                <div class="group" data-aos="fade-up" data-aos-delay="500">
                    <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-6 shadow-md group-hover:shadow-lg group-hover:-translate-y-2 transition-all duration-300 h-full">
                        <div class="mx-auto mb-4 w-24 h-24 flex items-center justify-center rounded-full bg-theme-pink-light text-theme-pink-dark text-4xl shadow-lg ring-4 ring-white"><i class="fas fa-futbol"></i></div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">4. Tunjukkan & Main!</h3>
                        <p class="text-gray-600 text-sm px-2">Datang ke lapangan pada hari-H, tunjukkan tiket PDF Anda kepada petugas, dan selamat bersenang-senang!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- SCRIPT UNTUK CAROUSEL --}}
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.review-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 30 }
            }
        });
    });
</script>

@endsection
