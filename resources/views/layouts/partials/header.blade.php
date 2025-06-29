<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f26682">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="{{ route('landing') }}">Zukira Booking</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item"><a class="nav-link text-white" href="/home">Dashboard</a></li>
          <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="nav-link btn btn-link" style="color: white;">Logout</button>
              </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
