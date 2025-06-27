<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Booking Lapangan</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- Header --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">BookingLapangan</a>
            <div>
                @auth
                    <span class="text-white me-3">Halo, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-sm btn-outline-light">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="bg-light py-3 mt-5">
        <div class="text-center">© 2025 Zukira Booking Lapangan</div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
