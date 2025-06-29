<!-- Topbar -->
<div class="topbar text-center text-white bg-success py-2 small">
    <span>📅 Senin - Sabtu, 08.00 - 22.00 | 📞 +62 880 0088 8808</span>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="#">Klinik Gigi Sehat🦷</a>

        <!-- Toggle (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center me-3">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('obat.index') }}">Beranda</a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex gap-2 align-items-center">
                @auth
                    <a href="{{ route('form.cek.pendaftar') }}" class="btn btn-outline-secondary btn-sm">
                        🔍 Cek
                    </a>
                    <a href="{{ route('image.upload') }}" class="btn btn-outline-warning btn-sm">
                        🖼️ Upload
                    </a>
                    <a href="{{ route('form.pendaftaran') }}" class="btn btn-success btn-sm">
                        📝 Daftar
                    </a>
                    <span class="text-success small ms-2">👋 Hai, {{ Auth::user()->nama }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
