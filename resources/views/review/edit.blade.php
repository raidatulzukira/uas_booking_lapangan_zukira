@extends('layouts.tailwind')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-400 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-pink-600 to-purple-500 bg-clip-text text-transparent">
                        Edit Review
                    </h1>
                    <p class="text-gray-600 text-sm sm:text-base mt-1">Perbarui pengalaman dan penilaian Anda</p>
                </div>
            </div>

            <!-- Review Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-pink-400 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $review->lapangan->nama }}</h3>
                        <p class="text-sm text-gray-600">Review untuk lapangan ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-green-800 font-medium">Berhasil!</p>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

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

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-red-800 font-medium mb-2">Mohon perbaiki kesalahan berikut:</p>
                        <ul class="text-red-700 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-500 to-purple-400 px-6 py-4">
                <h2 class="text-lg font-semibold text-white flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Review Anda
                </h2>
            </div>

            <form action="{{ route('review.update', $review->id) }}" method="POST" class="p-6 space-y-6" id="editReviewForm">
                @csrf
                @method('PUT')

                <!-- Current Rating Display -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Review Saat Ini</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600">{{ $review->rating }}/5</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2 italic">"{{ $review->komentar }}"</p>
                </div>

                <!-- Rating Selection -->
                <div class="space-y-2">
                    <label for="rating" class="block text-sm font-medium text-gray-700">
                        Rating Baru
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="rating" id="rating"
                                class="block w-full px-4 py-3 pr-10 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 appearance-none @error('rating') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Rating</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{ $i }}" {{ (old('rating', $review->rating) == $i) ? 'selected' : '' }} class="py-2">
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
                    @error('rating')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Rating Preview -->
                    <div id="rating-preview" class="flex items-center gap-2 {{ old('rating', $review->rating) ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-300">
                        <div class="flex gap-1" id="star-display">
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-5 h-5 {{ $i <= old('rating', $review->rating) ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-200"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span id="rating-text" class="text-sm text-gray-600">
                            @php
                                $currentRating = old('rating', $review->rating);
                                $ratingLabels = [1 => 'Sangat Kurang', 2 => 'Kurang', 3 => 'Cukup', 4 => 'Baik', 5 => 'Sangat Baik'];
                                echo $ratingLabels[$currentRating] ?? '';
                            @endphp
                        </span>
                    </div>
                </div>

                <!-- Review Content -->
                <div class="space-y-2">
                    <label for="komentar" class="block text-sm font-medium text-gray-700">
                        Isi Review Baru
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea name="komentar" id="komentar" rows="5"
                                  class="block w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 resize-none @error('komentar') border-red-500 @enderror"
                                  placeholder="Ceritakan pengalaman Anda menggunakan lapangan ini... (minimal 10 karakter)"
                                  required>{{ old('komentar', $review->komentar) }}</textarea>
                        <div class="absolute bottom-3 right-3 text-xs text-gray-400" id="char-count">
                            {{ strlen(old('komentar', $review->komentar)) }}/500 karakter
                        </div>
                    </div>
                    @error('komentar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
                            class="group relative flex-1 inline-flex items-center justify-center px-6 py-3 overflow-hidden text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-purple-400 rounded-xl hover:from-pink-600 hover:to-purple-400 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submitBtn">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-pink-500 to-purple-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <span id="submitText">Update Review</span>
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
document.addEventListener('DOMContentLoaded', function() {
    // Rating preview functionality
    const ratingSelect = document.getElementById('rating');
    const preview = document.getElementById('rating-preview');
    const starDisplay = document.getElementById('star-display');
    const ratingText = document.getElementById('rating-text');

    ratingSelect.addEventListener('change', function() {
        const rating = parseInt(this.value);

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
    const komentarTextarea = document.getElementById('komentar');
    const charCount = document.getElementById('char-count');

    komentarTextarea.addEventListener('input', function() {
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

    // Form submission with loading state
    const form = document.getElementById('editReviewForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');

    form.addEventListener('submit', function(e) {
        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Memproses...';

        // Add loading spinner
        const spinner = document.createElement('svg');
        spinner.className = 'animate-spin -ml-1 mr-2 h-4 w-4 text-white';
        spinner.fill = 'none';
        spinner.viewBox = '0 0 24 24';
        spinner.innerHTML = '<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>';

        const textSpan = submitText.parentNode;
        textSpan.insertBefore(spinner, submitText);
    });

    // Auto-save functionality (optional)
    let saveTimeout;
    function autoSave() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(() => {
            // You can implement auto-save to localStorage here
            const formData = {
                rating: ratingSelect.value,
                komentar: komentarTextarea.value,
                timestamp: new Date().toISOString()
            };
            localStorage.setItem('review_edit_draft_' + {{ $review->id }}, JSON.stringify(formData));
        }, 2000);
    }

    ratingSelect.addEventListener('change', autoSave);
    komentarTextarea.addEventListener('input', autoSave);

    // Load auto-saved data on page load
    const savedData = localStorage.getItem('review_edit_draft_' + {{ $review->id }});
    if (savedData) {
        try {
            const data = JSON.parse(savedData);
            if (data.rating) ratingSelect.value = data.rating;
            if (data.komentar) komentarTextarea.value = data.komentar;

            // Trigger events to update UI
            ratingSelect.dispatchEvent(new Event('change'));
            komentarTextarea.dispatchEvent(new Event('input'));
        } catch (e) {
            console.log('Error loading saved data:', e);
        }
    }

    // Clear auto-saved data on successful submission
    form.addEventListener('submit', function() {
        localStorage.removeItem('review_edit_draft_' + {{ $review->id }});
    });
});
</script>

<style>
.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
@endsection
