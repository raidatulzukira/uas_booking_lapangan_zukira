@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h4>Berikan Review untuk {{ $lapangan->nama }}</h4>

    <form action="/review" method="POST">
        @csrf
        <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">

        <div class="mb-3">
            <label>Rating (1 - 5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label>Komentar</label>
            <textarea name="komentar" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Review</button>
    </form>
</div>
@endsection
