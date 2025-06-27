@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3>Booking Lapangan: {{ $lapangan->nama }}</h3>
    <form action="/booking" method="POST">
        @csrf
        <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Booking</button>
    </form>
</div>
@endsection
