@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-3">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">🧾 Detail Pendaftar</h4>
        </div>
        <div class="card-body">
            {{-- Data Pendaftar --}}
            <div class="mb-4">
                <h5 class="mb-3 text-secondary">👤 Informasi Pribadi</h5>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <strong>Nama:</strong> {{ $pendaftar->nama }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Email:</strong> {{ $pendaftar->email }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d-m-Y') }}
                    </div>
                </div>
            </div>

            {{-- Alert Sukses --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Riwayat Antrian --}}
            <hr>
            <h5 class="mb-3 text-secondary">📋 Riwayat Nomor Pendaftaran</h5>

            @if($riwayatObat->isEmpty())
                <p class="text-muted">Belum ada riwayat antrian pemeriksaan.</p>
            @else
                <table class="table table-bordered table-striped table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>#ID Antrian</th>
                            <th>Tanggal Ambil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatObat as $obat)
                            <tr>
                                <td>#{{ $obat->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($obat->created_at)->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- Riwayat Pemeriksaan --}}
            <hr>
            <h5 class="mb-3 text-secondary">🩺 Riwayat Pemeriksaan</h5>

            @if($riwayat->isEmpty())
                <p class="text-muted">Belum ada riwayat pemeriksaan.</p>
            @else
                <table class="table table-bordered table-striped table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Penyakit</th>
                            <th>Diagnosa</th>
                            <th>Obat</th>
                            <th>Tanggal Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $r)
                            <tr>
                                <td>#{{ $r->id }}</td>
                                <td><span class="badge bg-warning text-dark">{{ $r->penyakit }}</span></td>
                                <td>{{ $r->diagnosa }}</td>
                                <td>{{ $r->obat ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal_pemeriksaan)->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- Tombol Kembali --}}
            <div class="text-end mt-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
