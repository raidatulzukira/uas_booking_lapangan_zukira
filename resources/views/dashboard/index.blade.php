@section('is_hero_page', true)

@extends('layouts.tailwind')

@section('content')

{{-- Latar belakang utama halaman bisa putih atau warna lain --}}
<div class="bg-white">

    {{-- ========================================================== --}}
    {{-- HERO SECTION BARU: GAMBAR SEBAGAI BACKGROUND FULL-WIDTH --}}
    {{-- ========================================================== --}}
    <div class="relative w-full min-h-[60vh] md:min-h-[70vh] flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('{{ asset('images/nba.jpg') }}');">

        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div>

        <div class="relative z-10 p-4">
            <p class="font-sans text-lg font-bold text-theme-pink-dark tracking-wider mb-2">ZUKIRA BOOKING</p>
            <h1 class="font-serif text-4xl md:text-6xl font-bold text-white mb-4">Pesan Lapangan Favoritmu</h1>
            <p class="font-sans text-md md:text-lg text-gray-200 max-w-2xl mx-auto mb-6">
                Selamat datang, {{ Auth::user()->name }}! Kelola jadwal booking dan lihat riwayat booking Anda dengan mudah.
            </p>
            <a href="{{ route('lapangan.index') }}" class="inline-flex items-center gap-3 bg-theme-pink-dark text-white font-bold py-3 px-6 rounded-lg hover:bg-opacity-90 transition-all shadow-md">
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
                        <h4 class="font-serif text-3xl font-bold text-gray-800 mb-6 text-center">Apa Kata Mereka?</h4>

            <div class="space-y-6">
                @if($reviews->isNotEmpty())
                    @foreach($reviews as $review)
                    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-4">
                        <div class="flex items-start gap-4">
                            <!-- Foto profil user -->
                            <img src="{{ asset('images/user.png') }}"
                                alt="Foto User"
                                class="w-12 h-12 rounded-full object-cover ring-2 ring-theme-pink-light">

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
                    <div class="text-center text-gray-500 py-8 px-4 rounded-xl bg-white shadow-sm border">
                        Belum ada review yang masuk.
                    </div>
                @endif
            </div>


        </div>

    </div>
</div>
@endsection
