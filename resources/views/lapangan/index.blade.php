@extends('layouts.tailwind')

@section('content')

<div class="container mx-auto px-4 py-6 md:py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Lapangan</h2>

    <div class="mb-8 p-4 bg-white rounded-xl shadow">
        {{-- Form Pencarian --}}
        <form class="relative mb-4" method="GET" action="">
            {{-- Menyimpan filter tipe yang sudah ada saat mencari --}}
            @if(request('tipe'))
                <input type="hidden" name="tipe" value="{{ request('tipe') }}">
            @endif
            <input type="text" name="search" class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-full focus:ring-2 focus:ring-theme-pink focus:border-transparent" placeholder="Cari berdasarkan nama lapangan..." value="{{ request('search') }}">
            <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-theme-pink-dark text-white rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-90" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>

        {{-- Tombol Filter Tipe --}}
        <div class="flex flex-wrap gap-2 items-center">
            <span class="font-semibold text-gray-700 mr-2">Filter Tipe:</span>
            <a href="?search={{ request('search') }}" class="px-4 py-1.5 rounded-full text-sm transition {{ !request('tipe') ? 'bg-theme-pink-dark text-white shadow' : 'bg-pink-100 text-theme-pink-dark hover:bg-pink-200' }}">
                Semua
            </a>
            @php
                // Ambil semua tipe unik dari koleksi, bukan hanya yang ditampilkan di halaman ini
                $tipeList = \App\Models\ZukiraLapangan::select('tipe')->distinct()->pluck('tipe');
            @endphp
            @foreach($tipeList as $tipe)
                <a href="?tipe={{ $tipe }}&search={{ request('search') }}" class="px-4 py-1.5 rounded-full text-sm transition {{ request('tipe') == $tipe ? 'bg-theme-pink-dark text-white shadow' : 'bg-pink-100 text-theme-pink-dark hover:bg-pink-200' }}">
                    {{ ucfirst($tipe) }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($lapangans as $lapangan)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transform hover:-translate-y-2 transition-transform duration-300">
                @if($lapangan->foto)
                    <img src="{{ asset('storage/' . $lapangan->foto) }}" alt="{{ $lapangan->nama }}" class="w-full h-56 object-cover">
                @else
                    <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400">Tanpa Gambar</div>
                @endif

                <div class="p-5 flex flex-col flex-grow">
                    <h5 class="text-xl font-bold text-gray-800">{{ $lapangan->nama }}</h5>
                    <p class="mb-3 mt-1">
                        <span class="bg-pink-100 text-theme-pink-dark font-semibold px-3 py-1 rounded-full text-xs">{{ ucfirst($lapangan->tipe) }}</span>
                    </p>
                    <div class="text-sm text-gray-600 mb-1 flex items-center">
                        <i class="fa fa-map-marker-alt text-theme-pink-dark w-5"></i>
                        <span class="ml-2">{{ $lapangan->lokasi }}</span>
                    </div>
                    <div class="text-lg font-bold text-gray-800 my-2">
                        Rp{{ number_format($lapangan->harga, 0, ',', '.') }} / jam
                    </div>

                    {{-- Menambahkan flex-grow agar tombol selalu di bawah --}}
                    <div class="mt-auto pt-4">
                        <a href="{{ route('booking.create', ['lapangan_id' => $lapangan->id]) }}" class="block w-full text-center bg-theme-pink-dark text-white font-bold py-2.5 px-4 rounded-lg hover:bg-opacity-90 transition shadow-lg">
                            Booking Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3 text-center text-gray-500 py-16 px-4 rounded-xl bg-white shadow">
                <p class="text-xl">Lapangan tidak ditemukan.</p>
                <p class="mt-2">Coba ganti kata kunci pencarian atau filter tipe Anda.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
