@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h3>Daftar Booking Masuk</h3>

    @foreach ($bookings as $booking)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $booking->user->name }}</p>
                <p><strong>Lapangan:</strong> {{ $booking->lapangan->nama }}</p>
                <p><strong>Tanggal:</strong> {{ $booking->tanggal }}</p>
                <p><strong>Jam:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
                <p><strong>Status:</strong> {{ $booking->status }}</p>

                @if($booking->status === 'pending')
                <form action="{{ url('/admin/bookings/konfirmasi/'.$booking->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Konfirmasi</button>
                </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
