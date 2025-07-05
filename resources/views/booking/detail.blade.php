@extends('layouts.tailwind')

@section('content')
{{-- Pastikan layouts.master Anda sudah memuat link ke Tailwind CSS dan Font Awesome --}}

<div class="bg-gray-50 min-h-screen font-sans">
    <div class="container mx-auto px-4 py-8 max-w-4xl">

        {{-- Pesan Sukses --}}
        @if(session('success'))
        <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-pink-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <strong class="text-pink-800">Sukses!</strong>
                    <span class="text-pink-700">{{ session('success') }}</span>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg border border-gray-200">
            <div class="p-6">
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-4 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-1">Detail Pemesanan</h1>
                        <span class="text-gray-500">ID Pesanan: #{{ $booking->id }}</span>
                    </div>
                    <div class="mt-4 sm:mt-0 text-left sm:text-right">
                        {{-- Badge Status Dinamis --}}
                        @if($booking->status === 'pending')
                        <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                            Menunggu Konfirmasi
                        </span>
                        @elseif($booking->status === 'dikonfirmasi')
                        <span class="inline-flex px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                            🔵 Dikonfirmasi
                        </span>
                        @else
                        <span class="inline-flex px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                            {{ ucfirst($booking->status) }}
                        </span>
                        @endif
                        <div class="text-gray-500 text-sm mt-1">
                            Tanggal Pesan: {{ \Carbon\Carbon::parse($booking->created_at)->translatedFormat('d M Y') }}
                        </div>
                    </div>
                </div>

                {{-- Main Content Layout --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Informasi Pemesan -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-user text-pink-500 mr-2"></i>
                                Informasi Pemesan
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Atas Nama</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->user->email ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Lapangan -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Lapangan</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Jenis Lapangan</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->lapangan->nama ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Main</span>
                                    <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Detail Waktu -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-calendar text-blue-500 mr-2"></i>
                                Detail Waktu
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">MULAI</span>
                                    <div class="text-right">
                                        <div class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} WIB</div>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">SELESAI</span>
                                    <div class="text-right">
                                        <div class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }} WIB</div>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Durasi</span>
                                    <span class="font-semibold text-gray-900">{{ $booking->duration_in_hours }} Jam</span>
                                </div>
                            </div>
                        </div>

                        <!-- Ringkasan Pembayaran -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-credit-card text-pink-500 mr-2"></i>
                                Ringkasan Pembayaran
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sewa Lapangan ({{ $booking->duration_in_hours }} jam)</span>
                                    <span class="font-semibold text-gray-900">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">  
                                    <span class="text-gray-600">Biaya Admin</span>
                                    <span class="font-semibold text-gray-900">Rp{{ number_format($booking->admin_fee, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">PPN (11%)</span>
                                    <span class="font-semibold text-gray-900">Rp{{ number_format($booking->tax, 0, ',', '.') }}</span>
                                </div>
                                <hr class="border-gray-300">
                                <div class="flex justify-between bg-blue-50 px-3 py-2 rounded">
                                    <span class="font-bold text-gray-900">Total Pembayaran</span>
                                    <span class="font-bold text-blue-600 text-lg">Rp{{ number_format($booking->final_total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Status & Button -->
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                            <span>Pembayaran Aman & Terpercaya</span>
                        </div>
                        
                        {{-- Tombol Aksi Dinamis --}}
                        @if($booking->status === 'dikonfirmasi')
                        <a href="#" class="w-full sm:w-auto px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 flex items-center justify-center">
                            <i class="fas fa-credit-card mr-2"></i>
                            Lanjut ke Pembayaran
                        </a>
                        @else
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="https://wa.me/6281213007587?text=Halo,%20saya%20ingin%20bertanya%20mengenai%20pesanan%20%23{{$booking->id}}" target="_blank" class="px-6 py-3 bg-pink-500 hover:bg-pink-700 text-white font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center justify-center">
                                <i class="fas fa-headset mr-2"></i>
                                Hubungi CS
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
