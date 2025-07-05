@extends('layouts.master')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 500px; width:100%;">
        <div class="card-body p-5">
            <h2 class="card-title text-center mb-2 fw-bold text-pink" style="color:#ea3766;">Booking Lapangan</h2>
            <p class="text-center text-muted mb-4">{{ $lapangan->nama }} ({{ $lapangan->tipe }})</p>
            <form action="{{ route('booking.store') }}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal" required>
                    <label for="tanggal">Tanggal</label>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="Jam Mulai" required>
                            <label for="jam_mulai">Jam Mulai</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Jam Selesai" required>
                            <label for="jam_selesai">Jam Selesai</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn w-100 py-2 fw-semibold text-white" style="background: linear-gradient(90deg,#ea3766 0%,#ff69b4 100%); box-shadow:0 2px 8px #ea376633;">Kirim Booking</button>
                <div class="form-text text-center mt-2">Status booking otomatis <span class="fw-bold text-pink" style="color:#ea3766;">pending</span> setelah submit.</div>
            </form>
        </div>
    </div>
</div>
@endsection
