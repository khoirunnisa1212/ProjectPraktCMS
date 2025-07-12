@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 fw-bold">
    <i class="fas fa-search me-2"></i>Cek Data Pasien
</h2>


    {{-- Form input ID --}}
    <form action="{{ route('obat.cek') }}" method="GET" class="card p-4 shadow-sm mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-9">
                <input type="number" name="id" class="form-control" placeholder="Masukkan ID Pendaftar" required>
            </div>
            <div class="col-md-3 text-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
            </div>
        </div>
    </form>

    {{-- Notifikasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Jika data ditemukan --}}
    @isset($data)
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-check me-2"></i>Detail Pendaftar
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 30%;">ID</th>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $data->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $data->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td>{{ $data->bb }} kg</td>
                </tr>
                <tr>
                    <th>Tinggi Badan</th>
                    <td>{{ $data->tb }} cm</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>{{ $data->telepon }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data->email }}</td>
                </tr>
            </table>
            <div class="text-end mt-3">
                <a href="{{ route('pendaftar.edit', $data->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>Edit Data
                </a>
            </div>
        </div>
    </div>
    @endisset

    <div class="text-left">
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Menu Utama
        </a>
    </div>

</div>
@endsection
