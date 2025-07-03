@extends('layouts.master')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-4">
    {{-- ✅ Hero Banner --}}
    <div class="p-4 bg-primary text-white rounded mb-4">
        <h1>Selamat Datang di Sistem Booking Lapangan Olahraga</h1>
        <p>Booking lapangan olahraga favoritmu dengan mudah dan cepat!</p>
        <a href="{{ route('login') }}" class="btn btn-light">Login untuk Booking</a>
    </div>

```
{{-- ✅ Search + Filter --}}
<form action="{{ route('landing') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Cari lapangan..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="tipe" class="form-control">
                <option value="">-- Semua Tipe --</option>
                <option value="Futsal">Futsal</option>
                <option value="Badminton">Badminton</option>
                <option value="Basket">Basket</option>
                <option value="Tenis">Tenis</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>

{{-- ✅ List Lapangan --}}
<h3 class="mb-3">Daftar Lapangan</h3>
<div class="row">
    @forelse ($lapangans as $lapangan)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $lapangan->foto) }}" class="card-img-top" alt="foto lapangan">
                <div class="card-body">
                    <h5 class="card-title">{{ $lapangan->nama }} ({{ $lapangan->tipe }})</h5>
                    <p class="card-text">{{ Str::limit($lapangan->deskripsi, 80) }}</p>
                    {{-- ✅ Rating bintang --}}
                    <p>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa fa-star {{ $i <= $lapangan->averageRating() ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                    </p>
                    <a href="{{ route('booking.create', ['lapangan_id' => $lapangan->id]) }}" class="btn btn-success">Booking Sekarang</a>
                </div>
            </div>
        </div>
    @empty
        <p>Tidak ada lapangan ditemukan.</p>
    @endforelse
</div>

{{-- ✅ Review Terbaru --}}
<h3 class="mt-5 mb-3">Review Terbaru</h3>
<div class="row">
    @foreach ($reviews as $review)
        <div class="col-md-6 mb-3">
            <div class="border p-3 rounded shadow-sm">
                <strong>{{ $review->user->name }}</strong> menilai <strong>{{ $review->lapangan->nama }}</strong><br>
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                @endfor
                <p class="mb-0 mt-1">"{{ $review->komentar }}"</p>
            </div>
        </div>
    @endforeach
</div>

{{-- ✅ Call to Action Section --}}
<div class="mt-5 p-4 bg-light text-center rounded">
    <h4>Booking mudah, cepat, dan terpercaya hanya di sini!</h4>
    <a href="{{ route('login') }}" class="btn btn-primary mt-2">Login untuk Booking</a>
</div>

{{-- ✅ Footer --}}
<footer class="mt-5 text-center text-muted">
    <hr>
    <p>&copy; {{ date('Y') }} Sistem Booking Lapangan Zukira. All rights reserved.</p>
    <p>Kontak: admin@lapangan.com | Alamat: Jl. Olahraga No.1 | Jam Operasional: 07.00 - 22.00</p>
</footer>
```

</div>
@endsection
