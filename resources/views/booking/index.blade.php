@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-pink fw-bold text-center" style="font-size:2rem; letter-spacing:1px;">Riwayat Booking Anda</h2>
    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm rounded-pill px-4 py-2 mb-4" style="font-size:1.1rem;">{{ session('success') }}</div>
    @endif
    @forelse ($bookings as $booking)
        <div class="card mb-5 border-0 rounded-4 shadow-lg position-relative overflow-hidden" style="background: linear-gradient(120deg, #fff 80%, #ffe4ef 100%);">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 text-center p-4 bg-white">
                    <img src="{{ $booking->lapangan->foto ? asset('storage/' . $booking->lapangan->foto) : asset('images/user.png') }}" alt="Foto Lapangan" class="img-fluid rounded-4 border border-pink-200 shadow" style="max-height:180px; object-fit:cover; transition:transform .3s;">
                </div>
                <div class="col-md-8">
                    <div class="card-body px-4 py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                            <div>
                                <span class="fw-bold text-pink" style="font-size:1.4rem; letter-spacing:.5px;">{{ $booking->lapangan->nama }}</span>
                                <span class="badge bg-secondary ms-2" style="font-size:.95rem;">{{ $booking->tanggal }}</span>
                            </div>
                            <div class="text-muted small mt-2 mt-md-0 d-flex align-items-center" style="font-size:1rem;">
                                <i class="fa fa-clock me-2 text-pink"></i>
                                <span class="fw-semibold">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="fw-semibold">Status:</span>
                            @if($booking->status === 'pending')
                                <span class="badge bg-warning text-dark shadow-sm px-3 py-2 rounded-pill" style="font-size:.95rem;">Menunggu Konfirmasi</span>
                            @elseif($booking->status === 'dikonfirmasi')
                                <span class="badge bg-success shadow-sm px-3 py-2 rounded-pill" style="font-size:.95rem;">Dikonfirmasi</span>
                            @elseif($booking->status === 'selesai')
                                <span class="badge bg-info text-white shadow-sm px-3 py-2 rounded-pill" style="font-size:.95rem;">Selesai</span>
                            @endif
                        </div>
                        @if($booking->status === 'dikonfirmasi')
                            <div class="alert alert-info mt-3 mb-0 d-flex align-items-center gap-2 rounded-3 shadow-sm" style="font-size:1rem;">
                                <i class="fa fa-money-bill-wave me-2 text-pink"></i>
                                <span>Silahkan bayar ke no rek <b>788965</b> atas nama Zukira Booking.</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 m-3" style="opacity:.08; font-size:5rem; pointer-events:none;">
                <i class="fa fa-calendar-check text-pink"></i>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary text-center rounded-pill shadow-sm" style="font-size:1.1rem;">Belum ada booking yang Anda lakukan.</div>
    @endforelse
</div>
@endsection
