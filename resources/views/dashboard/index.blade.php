@section('is_hero_page', true)

@extends('layouts.tailwind')

@section('content')

{{-- Latar belakang utama halaman bisa putih atau warna lain --}}
<div class="bg-gradient-to-br from-pink-50 to-pink-100">

    {{-- ========================================================== --}}
    {{-- HERO SECTION BARU: GAMBAR SEBAGAI BACKGROUND FULL-WIDTH --}}
    {{-- ========================================================== --}}
    <div class="relative w-full min-h-[60vh] md:min-h-[70vh] flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('{{ asset('images/nba.jpg') }}');">

        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div>

        <div class="relative z-10 p-4">
            <p data-aos="fade-down" data-aos-delay="100" class="font-sans text-lg font-bold text-theme-pink-dark tracking-wider mb-2">ZUKIRA BOOKING</p>
            <h1 data-aos="zoom-in" data-aos-delay="200" class="font-serif text-4xl md:text-6xl font-bold text-white mb-4">Pesan Lapangan Favoritmu</h1>
            <p data-aos="fade-up" data-aos-delay="300" class="font-sans text-md md:text-lg text-gray-200 max-w-2xl mx-auto mb-6">
                Selamat datang, {{ Auth::user()->name }}! Kelola jadwal booking dan lihat riwayat booking Anda dengan mudah.
            </p>
            <a data-aos="fade-up" data-aos-delay="400" href="{{ route('lapangan.index') }}" class="inline-flex items-center gap-3 bg-theme-pink-dark text-white font-bold py-2 px-4 rounded-lg hover:bg-opacity-90 transition-all shadow-md">
                <i class="fa fa-calendar-plus"></i>
                <span>Booking Lapangan Baru</span>
            </a>
        </div>
    </div>

    {{-- =================================================== --}}
    {{-- SISA KONTEN (REVIEW) - TETAP DI DALAM CONTAINER --}}
    {{-- =================================================== --}}
    <div class="container mx-auto px-4 py-8 md:py-12">

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p class="font-bold">Sukses</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div>
<<<<<<< HEAD
            <h4 data-aos="fade-up" data-aos-delay="100" class="font-serif text-3xl font-bold text-gray-800 mb-6 text-center">Apa Kata Mereka?</h4>

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
=======
    <h2 class="font-serif text-3xl font-bold text-gray-800 mb-6 text-center">Apa Kata Mereka Tentang Halaman Kami?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($reviews as $review)
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 flex flex-col transition-transform transform hover:-translate-y-2 hover:shadow-xl">
            {{-- Bagian User --}}
            <div class="flex items-center mb-4">
                <img class="h-12 w-12 rounded-full object-cover mr-4 border-2 border-pink-200" 
                     src="{{ $review->user->profile_photo_path ? asset('storage/' . $review->user->profile_photo_path) : asset('images/user.png') }}" 
                     alt="Foto {{ $review->user->name }}">
                <div>
                    <p class="font-bold text-gray-900">{{ $review->user->name }}</p>
                    <p class="text-sm text-gray-500">Review untuk {{ $review->lapangan->nama }}</p>
                </div>
            </div>

            {{-- Bagian Rating Bintang --}}
            <div class="text-yellow-400 mb-3 flex items-center">
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endfor
            </div>

            {{-- Komentar --}}
            <p class="text-gray-600 italic flex-grow">"{{ $review->komentar }}"</p>

            {{-- Tanggal --}}
            <div class="text-right text-xs text-gray-400 mt-4 pt-4 border-t border-gray-100">
                {{ $review->created_at->diffForHumans() }}
>>>>>>> 564e539b4445fc29805eaf91a31ebbf39532b3fd
            </div>
        </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-500 py-12 px-4 rounded-2xl bg-white shadow-lg border">
                <p>Belum ada review dari pengguna lain.</p>
            </div>
        @endforelse
    </div>
</div>


    </div>

    {{-- =================================================== --}}
    {{-- SECTION: KENAPA HARUS MEMILIH KAMI --}}
    {{-- =================================================== --}}
    <div class="py-16 px-4 md:px-8">
        <div class="max-w-6xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-theme-pink-dark mb-6">Kenapa Harus Memilih Kami?</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-md mb-12">
                Kami berkomitmen memberikan layanan terbaik bagi Anda yang ingin memesan lapangan olahraga dengan mudah, cepat, dan nyaman.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <!-- Keunggulan 1 -->
                <div class="bg-pink-50 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300" data-aos="zoom-in" data-aos-delay="100">
                    <div class="text-theme-pink-dark text-3xl mb-4">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Booking Online 24/7</h3>
                    <p class="text-gray-600 text-sm">
                        Anda bisa melakukan pemesanan kapan saja tanpa perlu datang langsung ke lokasi.
                    </p>
                </div>

                <!-- Keunggulan 2 -->
                <div class="bg-pink-50 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300" data-aos="zoom-in" data-aos-delay="200">
                    <div class="text-theme-pink-dark text-3xl mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Transaksi Aman</h3>
                    <p class="text-gray-600 text-sm">
                        Sistem kami terjamin keamanannya dengan bukti pembayaran dan riwayat lengkap.
                    </p>
                </div>

                <!-- Keunggulan 3 -->
                <div class="bg-pink-50 rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300" data-aos="zoom-in" data-aos-delay="300">
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
@endsection
