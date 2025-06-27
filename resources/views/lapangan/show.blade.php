@extends('layouts.app')
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
@endsection
