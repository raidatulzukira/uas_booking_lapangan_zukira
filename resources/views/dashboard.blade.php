@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h3>Selamat Datang, {{ auth()->user()->name }}!</h3>
    <p>Ini adalah halaman setelah login.</p>
</div>
@endsection
