@extends('layouts.master')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('logout'))
    <div class="alert alert-logout">
        {{ session('logout') }}
    </div>
@endif

<style>
    body {
        background-color: #fff0f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero-section {
        background: linear-gradient(135deg, #ffc0cb, #fff);
        padding: 80px 20px;
        text-align: center;
        border-radius: 12px;
    }

    .hero-section h1 {
        font-size: 42px;
        font-weight: bold;
        color: #ea3766;
    }

    .hero-section p {
        font-size: 18px;
        color: #444;
    }

    .hero-section .btn {
        background-color: #ff4979;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        color: white;
        border-radius: 20px;
        transition: background 0.3s;
    }

    .hero-section .btn:hover {
        background-color: #ea3766;
    }

    .lapangan-card {
        border: 1px solid #f8bbd0;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.2s;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(233, 30, 99, 0.1);
    }

    .lapangan-card:hover {
        transform: scale(1.02);
    }

    .lapangan-title {
        color: #ea3766;
        font-weight: bold;
    }

    .review-card {
        border-left: 4px solid #f06292;
        background-color: #fff;
        padding: 10px 15px;
        margin-bottom: 10px;
        border-radius: 8px;
    }

    .rating-stars {
        color: #ffc107;
    }

    .badge-tipe {
        background-color: #f8bbd0;
        color: #ea3766;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 12px;
    }

    .btn-pink {
    background-color: #ff4979;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 25px;
    transition: background 0.3s;
    }

    .alert-success {
        background-color: #ffe0ef !important;
        border-color: #ffb6d5 !important;
        color: #d63384 !important;
    }

    .alert-logout {
        background-color: #ffe0ef !important;
        border-color: #ffb6d5 important;
        color: #d63384 !important;
    }

</style>

<div class="container mt-4">

    <!-- Hero Banner -->
    <div class="hero-section mb-5">
        <h1>Selamat Datang di Zukira Booking Lapangan</h1>
        <p>Temukan dan pesan lapangan olahraga favoritmu hanya dengan beberapa klik</p>
        <a href="{{ route('login') }}" class="btn">Mulai Booking</a>

    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('landing') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari lapangan atau tipe...">
            <button class="btn btn-outline-danger" type="submit">Cari</button>
        </div>
    </form>

    <!-- Filter Tipe -->
    <div class="mb-3">
        <strong class="text-danger">Filter Tipe Lapangan:</strong>
        @php
            $tipeUnik = $lapangans->pluck('tipe')->unique();
        @endphp
        @foreach($tipeUnik as $tipe)
            <a href="{{ route('landing', ['search' => $tipe]) }}" class="badge-tipe me-2">{{ ucfirst($tipe) }}</a>
        @endforeach
    </div>

    <!-- List Lapangan -->
    <div class="row">
        @forelse ($lapangans as $lapangan)
            <div class="col-md-4 mb-4">
                <div class="lapangan-card">
                    @if($lapangan->foto)
                        <img src="{{ asset('storage/' . $lapangan->foto) }}" class="w-100" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex justify-content-center align-items-center" style="height: 200px;">
                            <span class="text-muted">Tanpa Gambar</span>
                        </div>
                    @endif
                    <div class="p-3">
                        <h5 class="lapangan-title">{{ $lapangan->nama }}</h5>
                        <p class="mb-2">Tipe: <span class="badge-tipe">{{ ucfirst($lapangan->tipe) }}</span></p>
                        <a href="/lapangan/{{ $lapangan->id }}" class="btn btn-sm btn-outline-danger">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada lapangan ditemukan.</p>
        @endforelse
    </div>

    <!-- Review Terbaru -->
    <div class="mt-5">
        <h4 class="text-danger mb-3">Ulasan Terbaru</h4>
        @forelse($reviews as $review)
            <div class="review-card">
                <strong>{{ $review->user->name }}</strong> pada
                <em>{{ $review->lapangan->nama }}</em>:
                <span class="rating-stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                <div>{{ $review->komentar }}</div>
            </div>
        @empty
            <p class="text-muted">Belum ada ulasan.</p>
        @endforelse
    </div>

    <!-- Call to Action -->
    <div class="text-center mt-5 mb-4">
        <h5 class="mb-3">Sudah Siap Olahraga?</h5>
        <a href="{{ route('login') }}" class="btn btn-pink btn-lg">Login & Booking Sekarang</a>

    </div>
</div>
@endsection
