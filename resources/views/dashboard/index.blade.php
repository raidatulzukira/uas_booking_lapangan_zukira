@extends('layouts.tailwind')

@section('content')

{{-- Container utama untuk konten dashboard --}}
<div class="container mx-auto px-4 py-6 md:py-8">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="text-center p-8 md:p-12 rounded-2xl bg-gradient-to-br from-pink-100 via-white to-pink-50 mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-theme-pink-dark mb-3">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-md text-gray-600 max-w-2xl mx-auto">Lihat riwayat booking dan review yang pernah Anda berikan di bawah ini.</p>
        <a href="{{ route('lapangan.index') }}" class="inline-block mt-6 bg-theme-pink-dark text-white font-bold py-3 px-8 rounded-full hover:bg-opacity-90 transition-transform transform hover:scale-105 shadow-lg">
            Booking Lapangan Baru
        </a>
    </div>

    <div>
        <h4 class="text-2xl font-bold text-gray-800 mb-4">Review Anda</h4>
        <div class="space-y-4">
            @if($reviews->isNotEmpty())
                @foreach($reviews as $review)
                <div class="bg-white rounded-xl shadow p-5 border-l-4 border-theme-pink-dark">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="font-bold text-lg text-gray-800">{{ $review->lapangan->nama }}</span>
                            <div class="text-yellow-400 mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    {{-- Menggunakan class 'opacity-40' untuk bintang yang tidak aktif --}}
                                    <i class="fa fa-star {{ $i <= $review->rating ? '' : 'opacity-40' }}"></i>
                                @endfor
                                <span class="ml-2 text-sm text-gray-500 font-medium">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                        <span class="text-gray-400 text-xs flex-shrink-0 ml-4">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</span>
                    </div>
                    <p class="text-gray-600 italic">"{{ $review->komentar }}"</p>
                </div>
                @endforeach
            @else
                <div class="text-center text-gray-500 py-8 px-4 rounded-xl bg-white shadow">Anda belum pernah memberikan review.</div>
            @endif
        </div>
    </div>

</div>

@endsection