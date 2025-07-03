@extends('layouts.master')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #fff0f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        transition: background-color 0.3s, color 0.3s;
    }
    .sidebar-custom {
        position: relative;
        top: 0;
        left: 0;
        width: 200px;
        background: #fff;
        border-right: 3.5px solid #ffb6d5;
        overflow-x: visible;
        z-index: 1100;
        box-shadow: 2px 0 16px #ffb6d5;
        padding-top: 0;
        margin-top: 0;
        margin-bottom: 0;
        display: flex;
        flex-direction: column;
        height: auto;
        min-height: 100%;
    }
    .dashboard-sidebar-wrapper {
        display: flex;
        align-items: stretch;
        min-height: unset;
        margin-top: 0;
        padding-top: 0;
        height: auto;
    }
    html, body {
        height: 100%;
    }
    .sidebar-custom .nav-link {
        color: #ea3766;
        font-weight: 500;
        margin-bottom: 10px;
        border-radius: 8px;
        background: none;
        white-space: nowrap;
        overflow: hidden;
        padding-left: 24px;
        padding-right: 12px;
        opacity: 1;
        pointer-events: auto;
    }
    .sidebar-custom .nav-link.active, .sidebar-custom .nav-link:hover {
        background: #ffe0ef;
        color: #d63384;
    }
    .sidebar-custom .nav-link i {
        margin-right: 0.5rem;
        font-size: 1.2rem;
        vertical-align: middle;
    }
    .main-content-custom {
        margin-left: 0;
        padding: 32px 24px 24px 24px;
        flex: 1 1 0%;
        min-width: 0;
    }
    @media (max-width: 768px) {
        .main-content-custom {
            padding: 16px 4px;
        }
    }
    .sidebar-custom, .main-content-custom {
        min-height: unset;
    }
    .lapangan-card-title {
        color: #ea3766;
        font-weight: 600;
        font-size: 1.2rem;
    }
    .lapangan-card-type {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }
    .lapangan-card-btn {
        background: #fff0f5;
        color: #ea3766;
        border: 1px solid #ea3766;
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
    }
    .lapangan-card-btn:hover {
        background: #ea3766;
        color: #fff;
    }
    .filter-btn {
        background: #ffe0ef;
        color: #ea3766;
        border: 1px solid #ea3766;
        border-radius: 16px;
        font-size: 0.95rem;
        margin-right: 6px;
        margin-bottom: 6px;
        padding: 2px 14px;
        transition: background 0.2s, color 0.2s;
    }
    .filter-btn.active, .filter-btn:hover {
        background: #ea3766;
        color: #fff;
    }
    .search-form-custom input[type="text"] {
        border-radius: 16px 0 0 16px;
        border: 1.5px solid #ea3766;
        padding-left: 16px;
    }
    .search-form-custom button {
        border-radius: 0 16px 16px 0;
        border: 1.5px solid #ea3766;
        background: #fff0f5;
        color: #ea3766;
        font-weight: 500;
        padding: 6px 18px;
        transition: background 0.2s, color 0.2s;
    }
    .search-form-custom button:hover {
        background: #ea3766;
        color: #fff;
    }
</style>
<div class="dashboard-sidebar-wrapper">
    {{-- <div id="sidebar" class="sidebar-custom">
        <ul class="nav flex-column mt-4">
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('booking*') ? 'active' : '' }}" href="/booking">
                    <i class="fa fa-calendar-check"></i> Data Booking
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('lapangan*') ? 'active' : '' }} active" href="/lapangan">
                    <i class="fa fa-futbol"></i> Data Lapangan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('review*') ? 'active' : '' }}" href="/review">
                    <i class="fa fa-star"></i> Data Review
                </a>
            </li>
        </ul>
    </div> --}}
    <div id="mainContent" class="main-content-custom">
        <h2 class="mb-4">Daftar Lapangan</h2>
        <!-- Filter Pencarian & Tipe -->
        <form class="search-form-custom d-flex mb-3" method="GET" action="">
            <input type="text" name="search" class="form-control" placeholder="Cari lapangan atau tipe..." value="{{ request('search') }}">
            <button type="submit">Cari</button>
        </form>
        <div class="mb-3">
            <span class="fw-bold me-2" style="color:#ea3766;">Filter Tipe Lapangan:</span>
            <a href="?{{ http_build_query(array_merge(request()->except('tipe'), ['tipe' => null])) }}" class="filter-btn{{ !request('tipe') ? ' active' : '' }}">Semua</a>
            @php $tipeList = $lapangans->pluck('tipe')->unique(); @endphp
            @foreach($tipeList as $tipe)
                <a href="?{{ http_build_query(array_merge(request()->except('tipe'), ['tipe' => $tipe])) }}" class="filter-btn{{ request('tipe') == $tipe ? ' active' : '' }}">{{ $tipe }}</a>
            @endforeach
        </div>
        <div class="row">
            @forelse ($lapangans as $lapangan)
                @if(!request('tipe') || request('tipe') == $lapangan->tipe)
                    @if(!request('search') || stripos($lapangan->nama, request('search')) !== false || stripos($lapangan->tipe, request('search')) !== false)
                    <div class="col-md-4 col-12 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $lapangan->foto) }}" class="card-img-top" style="height: 220px; object-fit: cover;">
                            <div class="card-body text-center">
                                <div class="lapangan-card-title mb-1">{{ $lapangan->nama }}</div>
                                <div class="lapangan-card-type mb-1">Tipe: <span class="badge bg-pink text-white" style="background:#ea3766;">{{ $lapangan->tipe }}</span></div>
                                <div class="mb-1"><i class="fa fa-map-marker-alt text-danger"></i> {{ $lapangan->lokasi }}</div>
                                <div class="mb-2"><strong>Rp{{ number_format($lapangan->harga, 0, ',', '.') }}</strong></div>
                                <a href="{{ route('booking.create', ['lapangan_id' => $lapangan->id]) }}" class="btn lapangan-card-btn">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
            @empty
                <div class="col-12">
                    <p class="text-muted text-center">Belum ada data lapangan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
