@extends('layouts.tailwind')

@section('title', 'Riwayat Booking')

@section('content')
<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-pink-50 to-pink-100">
    <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-6">Riwayat Booking Anda</h1>

    <div class="space-y-5">
        @forelse ($bookings as $booking)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 transition-shadow hover:shadow-lg">
                <div class="flex flex-col md:flex-row">

                    <!-- Gambar Lapangan -->
                    <div class="md:w-1/3">
                        <img src="{{ $booking->lapangan->foto ? asset('storage/' . $booking->lapangan->foto) : 'https://placehold.co/400x300/e2e8f0/334155?text=Lapangan' }}"
                             alt="Foto {{ $booking->lapangan->nama }}"
                             class="w-full h-36 object-cover">
                    </div>

                    <!-- Detail -->
                    <div class="p-4 md:w-2/3 flex flex-col justify-between text-sm">
                        <div>
                            <div class="flex flex-col sm:flex-row justify-between sm:items-start mb-1">
                                <h2 class="text-xl font-semibold text-gray-900">{{ $booking->lapangan->nama ?? 'Nama Lapangan' }}</h2>
                                <p class="text-gray-500">Booking ID #{{ $booking->id }}</p>
                            </div>
                            <div class="flex flex-wrap items-center text-gray-600 gap-3 mt-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->isoFormat('D MMM YYYY') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status dan Aksi -->
                        <div class="border-t border-gray-200 pt-3 mt-3 flex flex-col sm:flex-row justify-between items-center gap-3">
                            @php
                                $statusPembayaran = $booking->payment?->status_verifikasi;
                            @endphp

                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-700">Status:</span>
                                @if ($statusPembayaran == 'approved')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Lunas</span>
                                @elseif ($statusPembayaran == 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu</span>
                                @elseif ($statusPembayaran == 'rejected')
                                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">Belum Dibayar</span>
                                @endif
                            </div>

                            <div>
                                @if ($statusPembayaran == 'approved')
                                    <a href="{{ route('booking.downloadTicket', $booking->id) }}" class="text-white bg-pink-500 hover:bg-pink-600 font-semibold py-1.5 px-4 rounded-lg shadow-md transition-all">
                                        E-Tiket
                                    </a>
                                @else
                                    <a href="{{ route('payment.show', $booking->id) }}" class="text-white bg-rose-400 hover:bg-rose-800 font-semibold py-1.5 px-4 rounded-lg shadow-md transition-all">
                                        {{ $statusPembayaran == 'pending' ? 'Cek' : 'Bayar Sekarang' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-10 text-center border border-gray-200">
                <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum ada booking</h3>
                <p class="mt-1 text-sm text-gray-500">Anda belum pernah melakukan booking lapangan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
