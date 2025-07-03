<div class="flex justify-between items-center mb-4">
    <h5 class="text-xl font-semibold text-gray-700">Daftar Booking Terakhir</h5>
    <a href="{{ route('booking.create') }}" class="inline-block bg-pink-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-pink-700 transition-colors duration-300 shadow-sm hover:shadow-md">+ Booking Baru</a>
</div>
<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lapangan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @forelse($bookings as $booking)
                <tr class="border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->lapangan->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ date('H:i', strtotime($booking->jam_mulai)) }} - {{ date('H:i', strtotime($booking->jam_selesai)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="px-3 py-1 font-semibold rounded-full 
                            {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $booking->status == 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($booking->status == 'pending')
                            <a href="{{ route('booking.edit', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-6 text-gray-500">Belum ada data booking.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>