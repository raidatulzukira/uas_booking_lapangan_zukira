@section('is_hero_page', true)

@extends('layouts.tailwind')

@section('content')

{{-- ========================================================== --}}
{{-- HERO SECTION BARU: MENGGANTIKAN KOTAK GRADIENT PINK --}}
{{-- ========================================================== --}}
{{-- Hero section ini sengaja diletakkan di luar container agar lebarnya penuh --}}
<div class="relative w-full min-h-[60vh] md:min-h-[70vh] flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('{{ asset('images/bernabeu.jpg') }}');">

    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-60"></div>

    <div class="relative z-10 p-4">
        {{-- Anda bisa menyesuaikan teks ini sesuai kebutuhan halaman --}}
        <h1 class="font-serif text-4xl md:text-6xl font-bold text-white mb-4">Selamat Datang di Zukira Booking</h1>
        <p class="font-sans text-md md:text-lg text-gray-200 max-w-2xl mx-auto mb-6">
            Pesan lapangan futsal, badminton, dan lainnya dengan mudah di Padang.
        </p>
        <a href="{{ route('lapangan.index') }}" class="inline-flex items-center gap-3 bg-theme-pink-dark text-white font-bold py-3 px-6 rounded-lg hover:bg-opacity-90 transition-all shadow-md">
            <i class="fa fa-futbol"></i>
            <span>Lihat Semua Lapangan</span>
        </a>
    </div>
</div>

{{-- ============================================================= --}}
{{-- KONTEN REVIEW SEKARANG DI DALAM CONTAINER-NYA SENDIRI --}}
{{-- ============================================================= --}}
<div class="container mx-auto px-4 py-8 md:py-12 bg-gradient-to-br from-pink-50 to-pink-100">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div>
            <h4 data-aos="fade-up" data-aos-delay="100" class="font-serif text-3xl font-bold text-theme-pink-dark mb-6 text-center">Apa Kata Mereka?</h4>

            <div class="space-y-6">
                @if($reviews->isNotEmpty())
                    @foreach($reviews as $index => $review)
                    <div data-aos="fade-up" data-aos-delay="{{ 200 + ($index * 100) }}" class="bg-white rounded-2xl shadow-md border border-gray-200 p-4 max-w-3xl mx-auto">
                        <div class="flex items-start gap-4">
                            <!-- Foto profil user -->
                            <div class="w-12 h-12 p-1 rounded-full bg-white ring-2 ring-theme-pink-light">
                                <img src="{{ asset('images/user.png') }}"
                                    alt="Foto User"
                                    class="w-full h-full rounded-full object-cover">
                            </div>

                            <div class="flex-1">
                                <!-- Nama user -->
                                <div class="text-base font-semibold text-gray-800">
                                    {{ $review->user->name ?? 'Pengguna' }}
                                </div>

                                <!-- Nama lapangan -->
                                <div class="text-sm text-theme-pink-dark font-medium mt-0.5">
                                    {{ $review->lapangan->nama }}
                                </div>

                                <!-- Rating + Tanggal -->
                                <div class="flex items-center justify-between mt-2">
                                    <div class="text-theme-pink-dark">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star {{ $i <= $review->rating ? '' : 'opacity-30' }}"></i>
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-500 font-medium">{{ $review->rating }}/5</span>
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
                                    </div>
                                </div>

                                <!-- Komentar -->
                                <p class="mt-3 text-gray-600 text-sm leading-relaxed italic">"{{ $review->komentar }}"</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div data-aos="zoom-in" class="text-center text-gray-500 py-8 px-4 rounded-xl bg-white shadow-sm border max-w-2xl mx-auto">
                        Belum ada review yang masuk.
                    </div>
                @endif
            </div>
        </div>

        <div class="py-16 px-4 md:px-8">
            <div class="max-w-6xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-theme-pink-dark mb-6">Kenapa Harus Memilih Kami?</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-md mb-12">
                Kami berkomitmen memberikan layanan terbaik bagi Anda yang ingin memesan lapangan olahraga dengan mudah, cepat, dan nyaman.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <!-- Keunggulan 1 -->
                <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300" data-aos="zoom-in" data-aos-delay="100">
                    <div class="text-theme-pink-dark text-3xl mb-4">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Booking Online 24/7</h3>
                    <p class="text-gray-600 text-sm">
                        Anda bisa melakukan pemesanan kapan saja tanpa perlu datang langsung ke lokasi.
                    </p>
                </div>

                <!-- Keunggulan 2 -->
                <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300" data-aos="zoom-in" data-aos-delay="200">
                    <div class="text-theme-pink-dark text-3xl mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Transaksi Aman</h3>
                    <p class="text-gray-600 text-sm">
                        Sistem kami terjamin keamanannya dengan bukti pembayaran dan riwayat lengkap.
                    </p>
                </div>

                <!-- Keunggulan 3 -->
                <div class="bg-white ring-2 ring-theme-pink-light rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300" data-aos="zoom-in" data-aos-delay="300">
                    <div class="text-theme-pink-dark text-3xl mb-4">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Rating & Review Jelas</h3>
                    <p class="text-gray-600 text-sm">
                        Lihat pengalaman pengguna lain sebelum memesan, sehingga Anda lebih percaya diri memilih.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

    </div>
</div>

@endsection
