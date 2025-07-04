@extends('layouts.master') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="container py-5">

    {{-- Pesan Sukses (hanya tampil jika status masih 'pending') --}}
    @if($booking->status === 'pending')
        <div class="alert alert-success">
            <strong>Sukses!</strong> Order submitted successfully! Please wait for admin confirmation.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h3 class="mb-1">Detail Pemesanan</h3>
                    <span class="text-muted">ID Pesanan: {{ $booking->id }}</span>
                </div>
                <div>
                    {{-- Badge Status Dinamis --}}
                    @if($booking->status === 'pending')
                        <span class="badge bg-warning text-dark fs-6">Pending</span>
                    @elseif($booking->status === 'dikonfirmasi')
                        <span class="badge bg-success fs-6">Confirmed</span>
                    @else
                         <span class="badge bg-danger fs-6">{{ ucfirst($booking->status->value) }}</span>
                    @endif
                    <div class="text-muted text-end small mt-1">
                        Tanggal: {{ \Carbon\Carbon::parse($booking->tanggal)->format('d F Y') }}
                    </div>
                </div>
            </div>

            {{-- Detail Informasi Pemesan & Lapangan --}}
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5>Informasi Pemesan</h5>
                    <p class="mb-1"><strong>Atas Nama:</strong> {{ $booking->user->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $booking->user->email }}</p>
                </div>
                <div class="col-md-6 mb-4">
                     <h5>Detail Waktu</h5>
                    <p class="mb-1"><strong>Mulai:</strong> {{ $booking->jam_mulai }}</p>
                    <p class="mb-1"><strong>Selesai:</strong> {{ $booking->jam_selesai }}</p>
                </div>
                <div class="col-md-12 mb-4">
                     <h5>Informasi Lapangan</h5>
                    <p class="mb-1"><strong>Jenis Lapangan:</strong> {{ $booking->lapangan->nama }}</p>
                    {{-- Tambahkan info lain jika ada --}}
                </div>
            </div>

            <hr>

            <div class="row">
    <div class="col-md-6">
        {{-- Biarkan kolom ini kosong agar ringkasan berada di sebelah kanan --}}
    </div>
    <div class="col-md-6">
        <h5 class="mb-3">Ringkasan Pembayaran</h5>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td class="text-muted ps-0">Sewa Lapangan ({{ $durasiJam }} jam)</td>
                    <td class="text-end pe-0">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-muted ps-0">Biaya Admin</td>
                    <td class="text-end pe-0">Rp{{ number_format($biayaAdmin, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-muted ps-0">PPN (11%)</td>
                    <td class="text-end pe-0">Rp{{ number_format($ppn, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="fw-bold ps-0 border-top pt-3">Total Pembayaran</td>
                    <td class="fw-bold text-primary text-end pe-0 border-top pt-3 fs-5">
                        Rp{{ number_format($totalPembayaran, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
{{-- Tombol Aksi Dinamis --}}
<div class="text-center mt-3">
                @if($booking->status === 'dikonfirmasi')
                    {{-- Tampilan jika SUDAH dikonfirmasi admin --}}
                    <a href="#" class="btn btn-success btn-lg">
                        Lanjut ke Pembayaran
                    </a>
                @else
                     {{-- Tampilan jika MASIH pending (atau status lain) --}}
                    <div class="d-flex justify-content-center gap-3">
                        <button class="btn btn-secondary"><i class="fas fa-print me-1"></i> Unduh PDF</button>
                        <a href="https://wa.me/NOMOR_CS_ANDA" class="btn btn-primary"><i class="fas fa-headset me-1"></i> Hubungi CS</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection