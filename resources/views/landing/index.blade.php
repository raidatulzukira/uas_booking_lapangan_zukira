@section('is_hero_page', true)

@extends('layouts.tailwind')

@section('content')

{{-- ========================================================== --}}
{{-- HERO SECTION BARU: MENGGANTIKAN KOTAK GRADIENT PINK --}}
{{-- ========================================================== --}}
{{-- Hero section ini sengaja diletakkan di luar container agar lebarnya penuh --}}
<div class="relative w-full min-h-[60vh] md:min-h-[70vh] flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('{{ asset('images/bernabeu.jpg') }}');">
    
    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div>

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
<div class="container mx-auto px-4 py-8 md:py-12">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div>
        {{-- FONT JUDUL REVIEW DISESUAIKAN agar konsisten dengan desain baru --}}
        <h4 class="font-serif text-3xl font-bold text-gray-800 mb-6 text-center">Apa Kata Mereka?</h4>
        <div class="space-y-4">
            @if($reviews->isNotEmpty())
                @foreach($reviews as $review)
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-theme-pink-dark">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="font-sans font-bold text-lg text-gray-800">{{ $review->lapangan->nama }}</span>
                            {{-- WARNA BINTANG DISESUAIKAN agar cocok dengan tema pink --}}
                            <div class="text-theme-pink-dark mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= $review->rating ? '' : 'opacity-30' }}"></i>
                                @endfor
                                <span class="ml-2 text-sm text-gray-500 font-medium">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                        <span class="text-gray-400 text-xs flex-shrink-0 ml-4">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</span>
                    </div>
                    <p class="font-sans text-gray-600 italic">"{{ $review->komentar }}"</p>
                </div>
                @endforeach
            @else
                <div class="text-center text-gray-500 py-8 px-4 rounded-xl bg-white shadow-sm border">Belum ada review yang masuk.</div>
            @endif
        </div>
    </div>
</div>

@endsection