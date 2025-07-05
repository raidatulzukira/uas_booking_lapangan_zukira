@extends('layouts.tailwind')

@section('content')
<div class="container mx-auto px-4 py-12 flex justify-center items-center" style="min-height: 80vh;">
    <div class="w-full max-w-md">
        
        <form method="POST" action="{{ route('booking.store') }}" autocomplete="off">
            @csrf
            <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
                
                <div class="p-8">
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-bold text-theme-pink">Booking Lapangan</h2>
                        <p class="text-gray-600 mt-1">{{ $lapangan->nama }}</p>
                    </div>

                    {{-- Menampilkan semua error validasi di bagian atas --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                            <p class="font-bold">Oops! Terjadi kesalahan:</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Hidden input untuk lapangan_id --}}
                    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

                    {{-- Input Tanggal --}}
                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700 text-sm font-bold mb-2">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" 
                               class="shadow-sm appearance-none border @error('tanggal') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-400"
                               value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Jam Mulai & Selesai --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="jam_mulai" class="block text-gray-700 text-sm font-bold mb-2">Jam Mulai</label>
                            <input type="time" id="jam_mulai" name="jam_mulai"
                                   class="shadow-sm appearance-none border @error('jam_mulai') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-400"
                                   value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_selesai" class="block text-gray-700 text-sm font-bold mb-2">Jam Selesai</label>
                            <input type="time" id="jam_selesai" name="jam_selesai"
                                   class="shadow-sm appearance-none border @error('jam_selesai') border-red-500 @else border-gray-300 @enderror rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-400"
                                   value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="w-full bg-theme-pink hover:bg-theme-pink-dark text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                            Kirim Booking
                        </button>
                        <p class="text-gray-500 text-sm mt-3">Status booking otomatis <strong class="text-theme-pink">pending</strong> setelah submit.</p>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
