<div class="flex justify-between items-center mb-4">
    <h5 class="text-xl font-semibold text-gray-700">Review yang Anda Tulis</h5>
    <a href="{{ route('review.create') }}" class="inline-block bg-pink-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-pink-700 transition-colors duration-300 shadow-sm hover:shadow-md">+ Tulis Review</a>
</div>
<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lapangan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @forelse($reviews as $review)
                <tr class="border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $review->lapangan->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm flex items-center space-x-1 text-yellow-500">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa {{ $i < $review->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                        @endfor
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Illuminate\Support\Str::limit($review->komentar, 50) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                        <a href="{{ route('review.edit', $review->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('review.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus review?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center py-6 text-gray-500">Belum ada review dari Anda.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>