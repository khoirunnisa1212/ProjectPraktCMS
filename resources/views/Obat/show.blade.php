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
                <tr><th>ID</th><td>{{ session('pendaftar')->id }}</td></tr>
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
        <h2>Lihat Resep Obat</h2>
        <form action="{{ route('obat.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>ID Pendaftar:</label>
                <input type="text" name="id_pendaftar" class="form-control" required>
            </div>
    
            <button type="submit" class="btn btn-success mt-3">Lihat Resep</button>
        </form>

        @if(session('obat') && count(session('obat')) > 0)
            <div class="alert alert-info mt-4">
                <h5>Data Resep</h5>
                <ul>
                    @foreach(session('obat') as $data)
                        <li>ID Obat: {{ $data->id }}, Nama Obat: {{ $data->nama }}, Exp: {{ $data->tanggal_kedaluwarsa }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session('obat'))
            <div class="alert alert-warning mt-4">Data resep tidak ditemukan.</div>
        @endif
    @endif

    <a href="{{ route('obat.index') }}" class="btn btn-secondary mt-4">Kembali ke Menu Utama</a>
</div>

@endsection
