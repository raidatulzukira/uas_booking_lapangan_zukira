@extends('layouts.master')

@section('content')
<div class="container mt-4">
    {{-- Search Bar --}}
    <form action="/" method="GET" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Cari lapangan...">
    </form>

    {{-- List Lapangan --}}
    <h2 class="mb-3">Daftar Lapangan</h2>
    <div class="row">
        @foreach($lapangans as $lapangan)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $lapangan->foto) }}" class="card-img-top" alt="{{ $lapangan->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $lapangan->nama }} ({{ $lapangan->tipe }})</h5>
                        <p class="card-text">{{ $lapangan->lokasi }}</p>
                        <p><strong>Rp{{ number_format($lapangan->harga, 0, ',', '.') }}</strong></p>
                        <a href="{{ route('booking.create', ['lapangan_id' => $lapangan->id]) }}" class="btn btn-primary">Booking Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Review Terbaru --}}
    <h3 class="mt-5">Review Terbaru</h3>
    <div class="list-group">
        @foreach($reviews as $review)
            <div class="list-group-item">
                <strong>{{ $review->user->name }}</strong> memberi rating ⭐ {{ $review->rating }} untuk <strong>{{ $review->lapangan->nama }}</strong>
                <p class="mb-0">{{ $review->komentar }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
