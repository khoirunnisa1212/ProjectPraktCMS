@extends('layouts.app')

@section('content')

<div class="container mt-4">

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
            <hr>
            <h4>Detail Pendaftar Baru</h4>
            <table class="table table-bordered mt-3">
                <tr><th>ID_Pendaftar</th><td>{{ session('pendaftar')->id }}</td></tr>
                <tr><th>Nama</th><td>{{ session('pendaftar')->nama }}</td></tr>
                <tr><th>Tanggal Lahir</th><td>{{ session('pendaftar')->tanggal_lahir }}</td></tr>
                <tr><th>Jenis Kelamin</th><td>{{ session('pendaftar')->jenis_kelamin }}</td></tr>
                <tr><th>Berat Badan</th><td>{{ session('pendaftar')->bb }} kg</td></tr>
                <tr><th>Tinggi Badan</th><td>{{ session('pendaftar')->tb }} cm</td></tr>
                <tr><th>Telepon</th><td>{{ session('pendaftar')->telepon }}</td></tr>
                <tr><th>Email</th><td>{{ session('pendaftar')->email }}</td></tr>
            </table>

            <form action="{{ route('pendaftar.destroy', session('pendaftar')->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus Data</button>
            </form>
        @endif

    @elseif(session('type') == 'obat')
        <h2>Lihat Antrian Periksa dan Obat</h2>
        <form action="{{ route('obat.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>ID Pendaftar:</label>
                <input type="text" name="id_pendaftar" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="id_pendaftar" class="form-control" required>
            </div>
    
            <button type="submit" class="btn btn-success mt-3">Lihat Antrian</button>
        </form>

         @if(session('obat'))
            <hr>
            <h4>Detail Antrian Baru</h4>
            <table class="table table-bordered mt-3">
                <tr><th>Nomor Antrian</th><td>{{ session('obat')->id }}</td></tr>
                <tr><th>Id_Pendaftar</th><td>{{ session('obat')->Id_Pendaftar }}</td></tr>
                <tr><th>Nama</th><td>{{ session('obat')->nama }}</td></tr>
            </table>

            <form action="{{ route('obat.destroy', session('obat')->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus Data</button>
            </form>
        @endif
    @endif

    <a href="{{ route('obat.index') }}" class="btn btn-secondary mt-4">Kembali ke Menu Utama</a>
</div>

@endsection
