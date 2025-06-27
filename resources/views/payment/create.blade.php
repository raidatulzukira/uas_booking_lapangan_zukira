@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h4>Upload Bukti Pembayaran</h4>
    <p><strong>Lapangan:</strong> {{ $booking->lapangan->nama }}</p>

    <form action="/payments" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

        <div class="mb-3">
            <label>Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bukti Transfer</label>
            <input type="file" name="bukti_transfer" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Upload</button>
    </form>
</div>
@endsection
