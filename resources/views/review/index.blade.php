@extends('layouts.tailwind')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="space-y-2">
                <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-pink-600 to-purple-500 bg-clip-text text-transparent">
                    Review Pelanggan
                </h1>
                <p class="text-gray-600 text-sm sm:text-base">Testimoni dan pengalaman pelanggan kami</p>
            </div>

            @auth
                @if(Auth::user()->hasBooking())
                    <a href="{{ route('review.create', ['lapangan_id' =>  $review->lapangan_id ?? 1]) }}"
                       class="group relative inline-flex items-center px-6 py-3 overflow-hidden text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl hover:from-pink-600 hover:to-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-pink-600 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tulis Review
                        </span>
                    </a>
                @endif
            @endauth
        </div>

        @if($reviews->count())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($reviews as $review)
                    <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-pink-200">
                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-50/50 to-purple-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <div class="relative p-6">
                            <!-- User Info -->
                            <div class="flex items-center gap-4 mb-4">
                                <div class="relative">
                                    <!-- Bungkus img dalam div dengan ring -->
                                    <div class="w-14 h-14 rounded-full ring-2 ring-gray-200 group-hover:ring-pink-300 transition-all duration-300 p-1">
                                        <img src="{{ $review->user->profile_photo_url ?? asset('images/user.png') }}"
                                            alt="Foto Profile"
                                            class="w-full h-full rounded-full object-cover" />
                                    </div>

                                    <!-- Icon status -->
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 text-lg mb-1">{{ $review->user->name ?? 'Anonim' }}</h3>
                                    <p class="text-gray-600 text-sm bg-gray-100 px-3 py-1 rounded-full inline-block">
                                        {{ $review->lapangan->nama }}
                                    </p>
                                </div>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center gap-2 mb-4">
                                <div class="flex items-center gap-1">
                                    @for($i=1; $i<=5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-200"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm font-medium text-gray-700 bg-yellow-100 px-2 py-1 rounded-full">
                                    {{ $review->rating }}/5
                                </span>
                            </div>

                            <!-- Review Content -->
                            <div class="mb-4">
                                <p class="text-gray-700 leading-relaxed text-sm sm:text-base">
                                    "{{ $review->komentar }}"
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            @auth
                                @if(Auth::id() == $review->user_id)
                                    <div class="flex gap-3 pt-4 border-t border-gray-100">
                                        <a href="{{ route('review.edit', $review->id) }}"
                                           class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-amber-700 bg-blue-100 rounded-lg hover:bg-blue-100 transition-colors duration-200 border border-blue-200 hover:border-blue-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus review ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-700 bg-red-100 rounded-lg hover:bg-red-100 transition-colors duration-200 border border-red-200 hover:border-red-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Review</h3>
                    <p class="text-gray-600 mb-6">Jadilah yang pertama memberikan review untuk lapangan ini!</p>
                    @auth
                        @if(Auth::user()->hasBooking())
                            <a href="{{ route('review.create', ['lapangan_id' =>  $review->lapangan_id ?? 1]) }}"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-xl hover:from-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tulis Review Pertama
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
