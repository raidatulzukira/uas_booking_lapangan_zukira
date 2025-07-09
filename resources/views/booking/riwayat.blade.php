{{--
    File: resources/views/booking/riwayat.blade.php
    Deskripsi: Perbaikan dengan menghapus div pembungkus yang menyebabkan spasi.
--}}

@extends('layouts.tailwind')

@section('title', 'Riwayat Booking')

@section('content')
{{-- Div pembungkus yang menyebabkan masalah sudah dihapus. Langsung ke container. --}}
<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-8">Riwayat Booking Anda</h1>

    <div class="space-y-6">
        {{-- Loop untuk setiap booking --}}
        @forelse ($bookings as $booking)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 transition-shadow hover:shadow-xl">
                <div class="flex flex-col md:flex-row">
                    
                    <!-- Bagian Gambar Lapangan -->
                    <div class="md:w-1/3">
                        <img src="{{ $booking->lapangan->foto ? asset('storage/' . $booking->lapangan->foto) : 'https://placehold.co/400x300/e2e8f0/334155?text=Lapangan' }}" 
                             alt="Foto {{ $booking->lapangan->nama }}" 
                             class="w-full h-48 md:h-full object-cover">
                    </div>

                    <!-- Bagian Detail Booking -->
                    <div class="p-6 md:w-2/3 flex flex-col justify-between">
                        <div>
                            <div class="flex flex-col sm:flex-row justify-between sm:items-start mb-2">
                                <h2 class="text-2xl font-bold text-gray-900">{{ $booking->lapangan->nama ?? 'Nama Lapangan' }}</h2>
                                <p class="text-sm text-gray-500 mt-1 sm:mt-0">Booking ID #{{ $booking->id }}</p>
                            </div>
                            <div class="flex items-center text-gray-600 space-x-4 text-sm mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->isoFormat('dddd, D MMMM YYYY') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span>{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Status dan Tombol Aksi -->
                        <div class="border-t border-gray-200 pt-4 mt-4 flex flex-col sm:flex-row justify-between items-center">
                            @php
                                $statusPembayaran = $booking->payment?->status_verifikasi;
                            @endphp

                            <div class="flex items-center gap-2 mb-3 sm:mb-0">
                                <span class="font-semibold text-gray-700">Status Pembayaran:</span>
                                @if ($statusPembayaran == 'approved')
                                    <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Lunas</span>
                                @elseif ($statusPembayaran == 'pending')
                                    <span class="px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu Verifikasi</span>
                                @elseif ($statusPembayaran == 'rejected')
                                    <span class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                @else
                                    <span class="px-3 py-1 text-sm font-semibold text-gray-800 bg-gray-200 rounded-full">Belum Dibayar</span>
                                @endif
                            </div>

                            <div>
                                @if ($statusPembayaran == 'approved')
                                    <a href="{{ route('booking.downloadTicket', $booking->id) }}" class="bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                        Download E-Tiket
                                    </a>
                                @else
                                    <a href="{{ route('payment.show', $booking->id) }}" class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-2 px-5 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                        {{ $statusPembayaran == 'pending' ? 'Cek Pembayaran' : 'Bayar Sekarang' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Tampilan jika tidak ada booking --}}
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum ada booking</h3>
                <p class="mt-1 text-sm text-gray-500">Anda belum pernah melakukan booking lapangan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
