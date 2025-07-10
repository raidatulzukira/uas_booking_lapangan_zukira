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
</div>
@endsection
