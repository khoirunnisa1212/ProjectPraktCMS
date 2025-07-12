@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">
        <i class="fas fa-users-cog me-2"></i> Dashboard Admin - Data Pendaftar
    </h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari berdasarkan nama atau ID...">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search me-1"></i> Cari
            </button>
        </div>
    </form>

    {{-- Tabel data --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-table me-2"></i> Daftar Pendaftar
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Telepon</th>
                            <th>BB (kg)</th>
                            <th>TB (cm)</th>
                            <th>Data</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftars as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td class="text-start">{{ $p->nama }}</td>
                                <td class="text-start">{{ $p->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $p->jenis_kelamin === 'Laki-laki' ? 'primary' : 'danger' }}">
                                        {{ $p->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>{{ $p->telepon ?? '-' }}</td>
                                <td>{{ $p->bb ?? '-' }}</td>
                                <td>{{ $p->tb ?? '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                        <a href="{{ route('admin.pendaftar.detail', $p->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('admin.images', $p->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-file-alt"></i> Dokumen
                                        </a>
                                        <a href="{{ route('admin.pendaftar.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-notes-medical"></i> Hasil
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('admin.pendaftar.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4">Belum ada data pendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
