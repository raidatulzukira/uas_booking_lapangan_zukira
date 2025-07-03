<footer class="mt-0 text-white" style="background-color: #f26682;">
  <div class="container py-4">
    <div class="row">

      {{-- Navigasi Cepat --}}
      <div class="col-md-4">
        <h5>Menu Cepat</h5>
        <ul class="list-unstyled">
          <li><a href="/dashboard" class="text-white text-decoration-none">Dashboard</a></li>
          <li><a href="{{ route('booking.create') }}" class="text-white text-decoration-none">Booking Lapangan</a></li>
          <li><a href="{{ route('review.create') }}" class="text-white text-decoration-none">Tulis Review</a></li>
        </ul>
      </div>

      {{-- Sosial Media --}}
      <div class="col-md-4">
        <h5>Ikuti Kami</h5>
        <a href="https://www.youtube.com/@raidatulzukira7092" class="text-white me-3"><i class="fab fa-youtube"></i> Youtube</a><br>
        <a href="https://www.instagram.com/zukiraaa_" class="text-white me-3"><i class="fab fa-instagram"></i> Instagram</a><br>
        <a href="https://wa.me/6281213007587" class="text-white" target="_blank">
<i class="fab fa-whatsapp"></i> WhatsApp</a>
      </div>

      {{-- Form Kontak Mini --}}
      <div class="col-md-4">
        <h5>Hubungi Kami</h5>
        <form action="raidatulzukiraa@gmail.com" method="POST">
          <div class="mb-2">
            <input type="email" name="email" class="form-control form-control-sm" placeholder="Email Anda">
          </div>
          <div class="mb-2">
            <textarea name="pesan" rows="2" class="form-control form-control-sm" placeholder="Pesan"></textarea>
          </div>
          <button class="btn btn-light btn-sm" type="submit">Kirim</button>
        </form>
      </div>
    </div>

    <hr class="border-top border-white mt-4" />
    <p class="text-center mb-0">&copy; {{ date('Y') }} Zukira Booking Lapangan | Alamat: Padang | Kontak: 08123456789</p>
  </div>
</footer>
