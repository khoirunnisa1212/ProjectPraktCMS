@extends('layouts.app')

@section('content')

  <!-- Hero Section -->
  <section class="text-center py-5 bg-light">
    <div class="container">
      <h1 class="fw-bold">Selamat Datang di Klinik Gigi Sehat</h1>
      <p class="lead">Kami siap membantu Anda dengan layanan perawatan gigi terbaik.</p>
      <a href="#buatjanji" class="btn btn-success">Buat Janji Sekarang</a>
    </div>
  </section>

  <!-- Tentang -->
  <section id="tentang" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Tentang Kami</h2>
      <p class="text-center">Klinik Gigi Sehat telah berdiri sejak 2010 dan menyediakan layanan kesehatan gigi yang profesional dengan peralatan modern dan dokter yang berpengalaman.</p>
    </div>
  </section>

  <!-- Layanan -->
  <section id="layanan" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Layanan Kami</h2>
      <div class="row text-center">
        <div class="col-md-4">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title">Pemeriksaan Rutin</h5>
              <p class="card-text">Cek rutin kesehatan gigi Anda untuk mencegah masalah lebih lanjut.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title">Pemasangan Behel</h5>
              <p class="card-text">Layanan ortodonti dengan berbagai pilihan behel modern.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title">Pemutihan Gigi</h5>
              <p class="card-text">Gigi putih bersih dengan prosedur bleaching yang aman.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Jadwal Dokter (opsional untuk preview saja, detail bisa di show.blade.php) -->
  <section id="jadwal" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Jadwal Dokter</h2>
      <p class="text-center">Lihat detail jadwal dokter pada halaman detail masing-masing.</p>
      <div class="text-center">
        <a href="{{ route('obat.show', 1) }}" class="btn btn-outline-primary">Lihat Jadwal</a>
      </div>
    </div>
  </section>

  <!-- Form Buat Janji -->
  <section id="buatjanji" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Buat Janji</h2>
      <form method="POST" action="#">
        @csrf
        <div class="row mb-3">
          <div class="col-md-6">
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
          </div>
          <div class="col-md-6">
            <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP" required>
          </div>
        </div>
        <div class="mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success">Kirim Janji</button>
        </div>
      </form>
    </div>
  </section>
  <!-- Jadwal Dokter -->
  <section id="jadwal" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Jadwal Dokter</h2>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-success">
            <tr>
              <th>Nama Dokter</th>
              <th>Spesialis</th>
              <th>Hari Praktik</th>
              <th>Jam</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>drg. Andi Wijaya</td>
              <td>Spesialis Ortodonti</td>
              <td>Senin - Rabu</td>
              <td>08.00 - 12.00</td>
            </tr>
            <tr>
              <td>drg. Lisa Amelia</td>
              <td>Spesialis Bedah Mulut</td>
              <td>Kamis - Sabtu</td>
              <td>13.00 - 17.00</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Kontak Kami</h2>
      <p class="text-center">📍 Jl. Sehat Gigi No. 123, Jakarta<br>📞 021-8888-9999 | 📧 info@klinikgigisehat.id</p>
    </div>
  </section>

 <!-- Form Ulasan -->
<section id="ulasan" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Tinggalkan Ulasan Anda</h2>
    
    <form action="#" method="POST">
      @csrf
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Anda" required>
      </div>
      
      <div class="mb-3">
        <label for="ulasan" class="form-label">Ulasan</label>
        <textarea name="ulasan" id="ulasan" class="form-control" rows="4" placeholder="Tulis pendapat Anda..." required></textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
      </div>
    </form>
  </div>
</section>

@endsection
