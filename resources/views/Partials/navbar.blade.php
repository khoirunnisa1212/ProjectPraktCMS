<div class="topbar text-center text-white bg-success py-2">
  <span>📅 Senin - Sabtu, 08.00 - 22.00 | 📞 +62 880 0088 8808</span>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Klinik Gigi Sehat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('obat.index') }}">Beranda</a></li>
      </ul>
      <a href="{{ route('image.upload') }}" class="btn btn-outline-warning ms-3">🖼️📤</a>
      <a href="{{ route('form.pendaftaran') }}" class="btn btn-success ms-3">Daftar</a>
    </div>
  </div>
</nav>
