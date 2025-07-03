<!DOCTYPE html>
<html>
<head>
    <title>Booking Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<body>
    @include('layouts.partials.header')

    <!-- Tombol menu sidebar di header, setelah header (atau bisa di dalam header jika ingin menempel brand) -->
    {{-- <div class="sidebar-toggle-btn-header" id="sidebarToggleBtn">
        <i class="fa fa-bars" style="color:#ea3766; font-size:1.5rem;"></i>
    </div> --}}

    <main class="py-4">
        @yield('content')
    </main>

    @include('layouts.partials.footer')
</body>
</html>


{{-- <!DOCTYPE html>
<html>
<head>
    <title>Booking Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('landing') }}">BookingLapangan</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="/home">Dashboard</a></li>
          <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="nav-link btn btn-link" style="color: white;">Logout</button>
              </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- Konten -->
<main class="py-4">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3">
    &copy; {{ date('Y') }} Sistem Booking Lapangan Zukira
</footer>

</body>
</html> --}}
