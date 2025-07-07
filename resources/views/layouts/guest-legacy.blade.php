<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    {{-- ========================================================= --}}
    {{-- PERBAIKAN: Menggunakan path yang benar sesuai struktur folder Anda --}}
    {{-- ========================================================= --}}
    <link rel="stylesheet" href="{{ asset('assets/css/login-slider.css') }}">

    {{-- Link untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
</head>
<body>
    
    @yield('content')

    {{-- ========================================================= --}}
    {{-- PERBAIKAN: Menggunakan path yang benar sesuai struktur folder Anda --}}
    {{-- ========================================================= --}}
    <script src="{{ asset('assets/js/login-slider.js') }}"></script>
</body>
</html>
