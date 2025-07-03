<style>
    .profile-wrapper {
        background-color: #ffffff;
        border-radius: 50%;
        padding: 5px;
        box-shadow: 0 0 10px rgba(255, 182, 193, 0.5);
        display: inline-block;
        margin-left: 10px;
    }

    .profile-img {
        border-radius: 50%;
        width: 30px;
        height: 30px;
        object-fit: cover;
    }

    .dark-toggle {
        position: absolute;
        top: 80px;
        right: 20px;
        z-index: 1000;
    }

    .navbar-nav .nav-link {
        margin-right: 10px;
        border-radius: 8px;
        transition: background 0.2s, color 0.2s, border 0.2s;
        border: 2px solid transparent;
    }
    .navbar-nav .nav-link.fw-bold.bg-white.text-pink {
        background: none !important;
        color: #ea3766 !important;
        border: 2px solid #fff !important;
        background: #fed0e7 !important;
        font-weight: bold;
    }
    .navbar-nav .nav-link.fw-bold.bg-white.text-pink:hover,
    .navbar-nav .nav-link.fw-bold.bg-white.text-pink:focus {
        background: #fef3f8 !important;
        border: 2px solid #ea3766 !important;
        color: #ea3766 !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light py-3" style="background-color: #f26682;">
  <div class="container d-flex justify-content-between align-items-center">

    {{-- Logo / Brand --}}
    <a class="navbar-brand text-white fw-bold" href="{{ route('landing') }}">
        Zukira Booking
    </a>

    {{-- Teks sambutan --}}
    {{-- <div class="d-none d-md-block text-white me-3">
        Selamat datang, <strong>{{ Auth::user()->name }}</strong>
    </div> --}}

    {{-- Navbar Toggle untuk mobile --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Menu kanan --}}
    <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('dashboard') ? 'fw-bold bg-white text-pink rounded-3 px-3' : '' }}" href="/dashboard">
                    <i class="fa fa-home me-1"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('booking*') ? 'fw-bold bg-white text-pink rounded-3 px-3' : '' }}" href="/booking">
                    <i class="fa fa-calendar-check me-1"></i> Riwayat Booking
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('lapangan*') ? 'fw-bold bg-white text-pink rounded-3 px-3' : '' }}" href="/lapangan">
                    <i class="fa fa-futbol me-1"></i> Lapangan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->is('review*') ? 'fw-bold bg-white text-pink rounded-3 px-3' : '' }}" href="/review">
                    <i class="fa fa-star me-1"></i> Review Pelanggan
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-white" onclick="return confirm('Anda yakin ingin logout?')">Logout</button>
                </form>
            </li>
            <li class="nav-item">
                <div class="profile-wrapper">
                    <img src="{{ asset('images/user.png') }}" alt="Profile" class="profile-img">
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
            </li>
        @endif
    </ul>
    </div>
  </div>

</nav>

{{-- Tombol mode gelap di luar navbar agar tidak saling tumpuk --}}
<div class="dark-toggle">
    {{-- <button class="btn btn-light" onclick="document.body.classList.toggle('dark-mode')">
        <i class="fas fa-moon"></i>
    </button> --}}
    <button class="btn btn-primary btn-sm" id="dark-toggle-mode" onclick="document.body.classList.toggle('dark-mode')"><i class="fas fa-moon"></i></button>
</div>



  </div>
</nav>
