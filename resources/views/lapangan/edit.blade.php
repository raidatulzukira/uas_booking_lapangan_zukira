@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Edit Lapangan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Lapangan</label>
            <input type="text" name="nama" value="{{ $lapangan->nama }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <input type="text" name="tipe" value="{{ $lapangan->tipe }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <textarea name="lokasi" class="form-control" rows="3" required>{{ $lapangan->lokasi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $lapangan->harga }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Foto Baru (opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <p class="mt-2">Foto lama: <br><img src="{{ asset('storage/' . $lapangan->foto) }}" width="150"></p>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('lapangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
