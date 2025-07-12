<!-- Topbar -->
<div class="topbar text-center text-white bg-success py-2 small">
    <span>📅 Senin - Sabtu, 08.00 - 17.00 | 📞 +62 880 0088 8808</span>
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
                    @if(Auth::user()->role === 'pendaftar')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('obat.index') }}">Beranda</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex gap-2 align-items-center">
                @auth
                    @if(Auth::user()->role === 'pendaftar')
                        <a href="{{ route('form.cek.pendaftar') }}" class="btn btn-outline-secondary btn-sm">
                            🔍 Cek Data
                        </a>
                        <a href="{{ route('image.upload') }}" class="btn btn-outline-warning btn-sm">
                            🖼️ Upload
                        </a>
                        <a href="{{ route('riwayat.pemeriksaan') }}" class="btn btn-outline-success btn-sm">
                            🩺 Riwayat
                        </a>
                    @endif

                    <span class="text-success small ms-2">👋 Hai, {{ Auth::user()->nama }}</span>
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.jadwal') }}" class="btn btn-sm btn-outline-primary">
                        🗓️ Jadwal Dokter
                    </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
