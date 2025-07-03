@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            @if($lapangan->foto)
                <img src="{{ asset('storage/' . $lapangan->foto) }}" class="img-fluid rounded">
            @else
                <div class="bg-light d-flex justify-content-center align-items-center" style="height: 300px">
                    <span class="text-muted">Tanpa Gambar</span>
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <h2 class="text-danger">{{ $lapangan->nama }}</h2>
            <p><strong>Tipe:</strong> {{ ucfirst($lapangan->tipe) }}</p>
            <p><strong>Deskripsi:</strong> {{ $lapangan->deskripsi ?? 'Belum ada deskripsi.' }}</p>

            <a href="{{ route('booking.create', ['lapangan_id' => $lapangan->id]) }}" class="btn btn-danger mt-3">Booking Sekarang</a>
        </div>
    </div>
</div>
@endsection

{{-- @extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2>{{ $lapangan->nama }}</h2>
    <img src="{{ asset('uploads/lapangans/' . $lapangan->foto) }}" class="img-fluid mb-3">
    <p><strong>Tipe:</strong> {{ $lapangan->tipe }}</p>
    <p><strong>Lokasi:</strong> {{ $lapangan->lokasi }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($lapangan->harga) }}</p>

    <a href="/booking/create?lapangan_id={{ $lapangan->id }}" class="btn btn-success">Booking Sekarang</a>

    <hr>
    <h4>Review</h4>
    @forelse($reviews as $r)
        <div class="mb-2">
            <strong>{{ $r->user->name }}</strong> ({{ $r->rating }}/5): <br>
            <em>{{ $r->komentar }}</em>
        </div>
    @empty
        <p>Belum ada review.</p>
    @endforelse
</div>
@endsection --}}
