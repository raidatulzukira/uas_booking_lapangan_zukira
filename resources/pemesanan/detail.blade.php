@extends('layouts.app') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="container">
    {{-- BAGIAN 1: ALERT SUKSES (Hanya tampil jika status pending) --}}
    @if($pemesanan->status === 'pending')
        <div class="alert alert-success">
            Sukses! Order submitted successfully! Please wait for admin confirmation.
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0">Detail Pemesanan</h4>
                <p class="mb-0 text-muted">ID Pesanan: {{ $pemesanan->id }}</p>
            </div>
            <div>
                {{-- BAGIAN 2: BADGE STATUS DINAMIS --}}
                @if($pemesanan->status === 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($pemesanan->status === 'confirmed')
                    <span class="badge bg-success">Confirmed</span>
                @elseif($pemesanan->status === 'ditolak')
                    <span class="badge bg-danger">Ditolak</span>
                @endif
                <p class="mb-0 text-muted small mt-1">Tanggal: {{ $pemesanan->created_at->format('Y-m-d') }}</p>
            </div>
        </div>
        <div class="card-body">
            {{-- Tampilkan semua detail pemesanan di sini --}}
            <p><strong>Atas Nama:</strong> {{ $pemesanan->user->name }}</p>
            <p><strong>Email:</strong> {{ $pemesanan->user->email }}</p>
            <p><strong>Jenis Kendaraan:</strong> {{ $pemesanan->kendaraan->nama }}</p>
            {{-- ... tambahkan detail lainnya ... --}}
        </div>
        <div class="card-footer text-center">
            {{-- BAGIAN 3: TOMBOL AKSI DINAMIS --}}
            @if($pemesanan->status === 'confirmed')
                {{-- Tampilan jika sudah dikonfirmasi --}}
                <a href="/link-ke-pembayaran/{{ $pemesanan->id }}" class="btn btn-lg btn-success">
                    Lanjut ke Pembayaran
                </a>
            @else
                {{-- Tampilan jika masih pending atau status lainnya --}}
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-secondary">
                        <i class="fas fa-download me-2"></i> Unduh PDF
                    </button>
                    <a href="https://wa.me/628123456789" class="btn btn-primary">
                        <i class="fab fa-whatsapp me-2"></i> Hubungi CS
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection