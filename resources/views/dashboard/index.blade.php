@extends('layouts.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #fff0f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        transition: background-color 0.3s, color 0.3s;
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
    .sidebar-custom {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 0;
        background: #fff;
        border-right: 3.5px solid #ffb6d5;
        overflow-x: hidden;
        transition: width 0.3s cubic-bezier(.4,2,.6,1);
        z-index: 1100;
        box-shadow: 2px 0 16px #ffb6d5;
        padding-top: 0;
        margin: 0;
        /* Hapus shadow/efek yang menyebabkan gap visual */
    }
    /* Hilangkan margin/padding pada parent agar sidebar menempel ke header */
    .dashboard-sidebar-wrapper {
        position: relative;
        min-height: calc(100vh - 56px - 60px);
        margin-top: 0;
        padding-top: 0;
    }
    .sidebar-custom.open {
        width: 200px;
    }
    .sidebar-custom .nav-link {
        color: #ea3766;
        font-weight: 500;
        margin-bottom: 10px;
        border-radius: 8px;
        transition: background 0.2s, color 0.2s, padding 0.3s, opacity 0.2s;
        white-space: nowrap;
        overflow: hidden;
        padding-left: 24px;
        padding-right: 12px;
        opacity: 0;
        pointer-events: none;
    }
    .sidebar-custom.open .nav-link {
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
        transition: margin-left 0.3s cubic-bezier(.4,2,.6,1);
        margin-left: 48px;
        padding: 32px 24px;
    }
    .main-content-custom.shifted {
        margin-left: 200px;
    }
    @media (max-width: 768px) {
        .main-content-custom {
            padding: 16px 4px;
        }
    }
    .sidebar-custom, .main-content-custom {
        min-height: unset;
    }
    .sidebar-toggle-btn-header {
        position: absolute;
        top: 12px;
        left: 24px;
        z-index: 1200;
        background: #fff;
        border: 1.5px solid #ffb6d5;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 2px 2px 8px #ffb6d5;
        cursor: pointer;
        transition: background 0.2s;
    }
    .sidebar-toggle-btn-header:hover {
        background: #ffe0ef;
    }
    @media (max-width: 768px) {
        .sidebar-toggle-btn-header {
            top: 8px;
            left: 8px;
            width: 38px;
            height: 38px;
        }
    }
</style>

<!-- Main Content -->
<div class="container py-5">
    <!-- Hero Banner -->
    <div class="hero-section mb-5">
        <h1>Selamat Datang di Zukira Booking Lapangan</h1>
        <p>Temukan dan pesan lapangan olahraga favoritmu hanya dengan beberapa klik</p>
        <a href="{{ route('lapangan.index') }}" class="btn">Mulai Booking</a>
    </div>
    <div class="max-w-3xl mx-auto">
        <h4 class="text-pink-600 font-bold text-2xl mb-6">Review Anda</h4>
        <div class="space-y-6">
            @forelse($reviews as $review)
            <div class="rounded-2xl shadow p-6 border border-pink-200" style="background: #ffe0ef;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                    <span class="font-semibold text-lg text-pink-700">{{ $review->lapangan->nama }}</span>
                    <span class="text-gray-400 text-sm mt-2 md:mt-0">{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star text-yellow-400 text-lg mr-1"></i>
                    @endfor
                    <span class="ml-2 text-gray-700 font-medium">{{ $review->rating }}/5</span>
                </div>
                <div class="italic text-gray-700">"{{ $review->komentar }}"</div>
            </div>
            @empty
            <div class="text-center text-gray-400 py-8 rounded-xl shadow" style="background: #ffe0ef;">Belum ada review Anda.</div>
            @endforelse
        </div>
    </div>
</div>

<div class="container mt-4">
    {{-- <!-- Hero Banner -->
    <div class="hero-section mb-5">
        <h1>Selamat Datang di Zukira Booking Lapangan</h1>
        <p>Temukan dan pesan lapangan olahraga favoritmu hanya dengan beberapa klik</p>
        <a href="{{ route('login') }}" class="btn">Mulai Booking</a>

    </div> --}}
    <!-- ...existing code... -->
</div>

<style>
.btn-outline-pink {
    border: 1.5px solid #ea3766;
    color: #ea3766;
    background: #fff0f5;
    border-radius: 8px;
    transition: background 0.2s, color 0.2s;
}
.btn-outline-pink:hover {
    background: #ea3766;
    color: #fff;
}
</style>

<!--
Pindahkan kode berikut ke dalam elemen header di layouts/master.blade.php, tepat setelah logo/brand:
<div class="sidebar-toggle-btn-header" id="sidebarToggleBtn">
    <i class="fa fa-bars" style="color:#ea3766; font-size:1.5rem;"></i>
</div>
-->

@endsection
