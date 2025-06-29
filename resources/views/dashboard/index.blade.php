@extends('layouts.master')

@section('content')

<div class="mb-4">
    <h4>Daftar Lapangan</h4>
    <div class="row">
        @foreach($lapangans as $lap)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $lap->foto) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $lap->nama }} ({{ $lap->tipe }})</h5>
                        <a href="{{ route('booking.create', ['lapangan_id' => $lap->id]) }}" class="btn btn-primary">Booking</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="mb-4">
    <h4>Booking Anda</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lapangan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->lapangan->nama }}</td>
                    <td>{{ $booking->tanggal }}</td>
                    <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        @if($booking->status == 'pending')
                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mb-4">
    <h4>Review Anda</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Lapangan</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->lapangan->nama }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->komentar }}</td>
                    <td>
                        <a href="{{ route('review.edit', $review->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('review.destroy', $review->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus review?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
