@extends('layouts.tailwind')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-400 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-pink-600 to-purple-500 bg-clip-text text-transparent">
                        Tulis Review
                    </h1>
                    <p class="text-gray-600 text-sm sm:text-base mt-1">Bagikan pengalaman Anda dengan pengguna lain</p>
                </div>
            </div>
        </div>

        <!-- Error Alert -->
        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-red-800 font-medium">Terjadi Kesalahan</p>
                        <p class="text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-500 to-purple-400 px-6 py-4">
                <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Form Review
                </h2>
            </div>

            <form action="{{ route('review.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Lapangan Selection -->
                <div class="space-y-2">
                    <label for="lapangan_id" class="block text-sm font-medium text-gray-700">
                        Pilih Lapangan
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="lapangan_id" id="lapangan_id"
                                class="block w-full px-4 py-3 pr-10 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-200 appearance-none"
                                required>
                            <option value="">-- Pilih Lapangan --</option>
                            @foreach($bookedLapangan as $lapangan)
                                <option value="{{ $lapangan->id }}" class="py-2">{{ $lapangan->nama }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Hanya lapangan yang pernah Anda booking yang dapat direview
                    </p>
                </div>

                <!-- Rating Selection -->
                <div class="space-y-2">
                    <label for="rating" class="block text-sm font-medium text-gray-700">
                        Rating
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="rating" id="rating"
                                class="block w-full px-4 py-3 pr-10 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-200 appearance-none"
                                required>
                            <option value="">Pilih Rating</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{ $i }}" class="py-2">
                                    {{ $i }} Bintang {{ $i == 5 ? '(Excellent)' : ($i == 4 ? '(Good)' : ($i == 3 ? '(Average)' : ($i == 2 ? '(Poor)' : '(Very Poor)'))) }}
                                </option>
                            @endfor
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- Rating Preview -->
                    <div id="rating-preview" class="flex items-center gap-2 opacity-0 transition-opacity duration-300">
                        <div class="flex gap-1" id="star-display">
                            <!-- Stars will be populated by JavaScript -->
                        </div>
                        <span id="rating-text" class="text-sm text-gray-600"></span>
                    </div>
                </div>

                <!-- Review Content -->
                <div class="space-y-2">
                    <label for="komentar" class="block text-sm font-medium text-gray-700">
                        Isi Review
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea name="komentar" id="komentar" rows="5"
                                  class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-200 resize-none"
                                  placeholder="Ceritakan pengalaman Anda menggunakan lapangan ini... (minimal 10 karakter)"
                                  required>{{ old('komentar') }}</textarea>
                        <div class="absolute bottom-3 right-3 text-xs text-gray-400" id="char-count">
                            0/500 karakter
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Berikan review yang jujur dan konstruktif untuk membantu pengguna lain
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                    <button type="submit"
                            class="group relative flex-1 inline-flex items-center justify-center px-6 py-3 overflow-hidden text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-purple-400 rounded-xl hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-pink-300 to-purple-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Review
                        </span>
                    </button>

                    <a href="{{ route('review.index') }}"
                       class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Rating preview functionality
document.getElementById('rating').addEventListener('change', function() {
    const rating = parseInt(this.value);
    const preview = document.getElementById('rating-preview');
    const starDisplay = document.getElementById('star-display');
    const ratingText = document.getElementById('rating-text');

    if (rating) {
        // Clear existing stars
        starDisplay.innerHTML = '';

        // Add stars
        for (let i = 1; i <= 5; i++) {
            const star = document.createElement('svg');
            star.className = `w-5 h-5 ${i <= rating ? 'text-yellow-400' : 'text-gray-300'} transition-colors duration-200`;
            star.fill = 'currentColor';
            star.viewBox = '0 0 20 20';
            star.innerHTML = '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>';
            starDisplay.appendChild(star);
        }

        // Set rating text
        const ratingLabels = {
            1: 'Sangat Kurang',
            2: 'Kurang',
            3: 'Cukup',
            4: 'Baik',
            5: 'Sangat Baik'
        };
        ratingText.textContent = ratingLabels[rating];

        // Show preview
        preview.classList.remove('opacity-0');
        preview.classList.add('opacity-100');
    } else {
        preview.classList.remove('opacity-100');
        preview.classList.add('opacity-0');
    }
});

// Character count functionality
document.getElementById('komentar').addEventListener('input', function() {
    const charCount = document.getElementById('char-count');
    const length = this.value.length;
    charCount.textContent = `${length}/500 karakter`;

    if (length > 500) {
        charCount.classList.add('text-red-500');
        charCount.classList.remove('text-gray-400');
    } else {
        charCount.classList.remove('text-red-500');
        charCount.classList.add('text-gray-400');
    }
});
</script>
@endsection
