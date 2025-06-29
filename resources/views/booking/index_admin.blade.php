@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Data Booking Lapangan</h3>

    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-pink text-white">
            <tr>
                <th>Customer</th>
                <th>Lapangan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->lapangan->nama }}</td>
                <td>{{ $booking->tanggal }}</td>
                <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                <td>
                    <span class="badge {{ $booking->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td>
                    @if($booking->status == 'pending')
                        <form action="{{ route('booking.konfirmasi', $booking->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-success">Konfirmasi</button>
                        </form>
                    @else
                        <span class="text-muted">Sudah dikonfirmasi</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('styles')
<style>
.table-pink {
    background-color: #ff69b4;
}
</style>
@endpush
