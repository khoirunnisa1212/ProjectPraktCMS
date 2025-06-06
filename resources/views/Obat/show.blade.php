@extends('layouts.app')

@section('content')

<div class="container mt-4">

    @if(session('type') == 'pendaftaran')
        <h2>Form Pendaftaran Pelanggan</h2>
        <form action="{{ route('pendaftaran.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Berat Badan (kg):</label>
                <input type="number" name="bb" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tinggi Badan (cm):</label>
                <input type="number" name="tb" class="form-control" required>
            </div>
            <div class="form-group">
                <label>No Telepon:</label>
                <input type="text" name="telepon" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Daftar</button>
        </form>

       @if(session('pendaftar'))
<div class="container mt-5">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> Data pendaftar berhasil disimpan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card shadow animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-user"></i> Detail Pendaftar Baru
            </h4>
            <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#pendaftarDetail">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div id="pendaftarDetail" class="collapse show">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th style="width: 30%;">ID Pendaftar</th>
                        <td>{{ session('pendaftar')->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ session('pendaftar')->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ session('pendaftar')->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ session('pendaftar')->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Berat Badan</th>
                        <td>{{ session('pendaftar')->bb }} kg</td>
                    </tr>
                    <tr>
                        <th>Tinggi Badan</th>
                        <td>{{ session('pendaftar')->tb }} cm</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ session('pendaftar')->telepon }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ session('pendaftar')->email }}</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end gap-2">
                    <!-- Tombol Hapus -->
                    <form action="{{ route('pendaftar.destroy', session('pendaftar')->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Hapus Data
                        </button>
                    </form>

                    <!-- Tombol Ambil Antrian -->
                    <a href="{{ route('form.obat') }}" class="btn btn-info">
                        <i class="fas fa-clipboard-list"></i> Ambil Antrian
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan Animate.css CDN & Font Awesome di layout -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<script>
    let deleteForm;
    function confirmDelete(event) {
        event.preventDefault();
        deleteForm = event.target;
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        deleteForm.submit();
    });
</script>


    @elseif(session('type') == 'obat')
    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <h2>Lihat Antrian Periksa dan Obat</h2>
        <form action="{{ route('obat.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>ID Pendaftar:</label>
                <input type="text" name="id_pendaftar" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
    
            <button type="submit" class="btn btn-success mt-3">Lihat Antrian</button>
        </form>

         @if(session('obat'))
    <hr>
    <h4 class="mt-4">Detail Antrian Baru</h4>

    <div class="d-flex justify-content-left">
        <div class="text-center p-3 border border-3 rounded-3 shadow-sm" style="max-width: 300px;">
            <div class="text-muted mb-2">Nomor Antrian</div>
            <div class="fs-1 fw-bold text-primary border border-2 rounded-2 py-2 px-3">
                #{{ session('obat')->id }}
            </div>
            <hr>
            <div class="mb-1">
                <strong>ID Pendaftar:</strong> {{ session('obat')->Id_Pendaftar }}
            </div>
            <div>
                <strong>Nama:</strong> {{ session('obat')->nama }}
            </div>
        </div>
    </div>
@endif
@endif


    <a href="{{ route('obat.index') }}" class="btn btn-secondary mt-4">Kembali ke Menu Utama</a>
</div>

@endsection
