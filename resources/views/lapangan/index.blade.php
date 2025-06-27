@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Data Lapangan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('lapangan.create') }}" class="btn btn-success mb-3">+ Tambah Lapangan</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Lokasi</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lapangans as $lapangan)
                <tr>
                    <td>{{ $lapangan->nama }}</td>
                    <td>{{ $lapangan->tipe }}</td>
                    <td>{{ $lapangan->lokasi }}</td>
                    <td>Rp{{ number_format($lapangan->harga, 0, ',', '.') }}</td>
                    <td><img src="{{ asset('storage/' . $lapangan->foto) }}" width="80"></td>
                    <td>
                        <a href="{{ route('lapangan.edit', $lapangan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('lapangan.destroy', $lapangan->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if ($lapangans->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Belum ada data lapangan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
