@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Booking Lapangan: <strong>{{ $lapangan->nama }}</strong> ({{ $lapangan->tipe }})</h3>

    <form action="{{ route('booking.store') }}" method="POST" class="p-4 shadow rounded bg-white" style="max-width: 600px">
        @csrf
        <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-pink text-white">Kirim Booking</button>
    </form>
</div>
@endsection

@push('styles')
<style>
.btn-pink {
    background-color: #ff69b4;
}
</style>
@endpush
