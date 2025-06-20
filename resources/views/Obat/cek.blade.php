@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Cek Data Pendaftar</h2>

    {{-- Form input ID --}}
    <form action="{{ route('obat.cek') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="number" name="id" class="form-control" placeholder="Masukkan ID Pendaftar" required>
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    {{-- Notifikasi Error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Jika data ditemukan --}}
    @isset($data)
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4>Detail Pendaftar</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>ID</th><td>{{ $data->id }}</td></tr>
                <tr><th>Nama</th><td>{{ $data->nama }}</td></tr>
                <tr><th>Tanggal Lahir</th><td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</td></tr>
                <tr><th>Jenis Kelamin</th><td>{{ $data->jenis_kelamin }}</td></tr>
                <tr><th>Berat Badan</th><td>{{ $data->bb }} kg</td></tr>
                <tr><th>Tinggi Badan</th><td>{{ $data->tb }} cm</td></tr>
                <tr><th>Telepon</th><td>{{ $data->telepon }}</td></tr>
                <tr><th>Email</th><td>{{ $data->email }}</td></tr>
            </table>
        </div>
    </div>
    @endisset

    <a href="{{ route('obat.index') }}" class="btn btn-secondary mt-4">Kembali ke Menu Utama</a>

</div>
@endsection
