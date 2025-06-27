@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Tambah Lapangan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lapangan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama Lapangan</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <input type="text" name="tipe" class="form-control" placeholder="contoh: futsal, tenis" required>
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <textarea name="lokasi" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('lapangan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
