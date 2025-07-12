@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>🗓️ Input Jadwal Dokter Gigi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.jadwal.store') }}" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="nama_dokter" class="form-control" placeholder="Nama Dokter" required>
            </div>
            <div class="col-md-2">
                <select name="hari" class="form-control" required>
                    <option value="">Pilih Hari</option>
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="shift" class="form-control" required>
                    <option value="">Pilih Shift</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Siang">Siang</option>
                    <option value="Sore">Sore</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="col-md-2">
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>

<h5>📋 Jadwal Praktik Dokter</h5>
<table class="table table-bordered mt-3 text-center">
    <thead class="table-light">
        <tr>
            <th>Nama Dokter</th>
            <th>Hari</th>
            <th>Shift</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jadwals as $jadwal)
            <tr>
                <td>{{ $jadwal->nama_dokter }}</td>
                <td>{{ $jadwal->hari }}</td>
                <td>{{ $jadwal->shift }}</td>
                <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                <td>
                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    {{-- Tombol Kembali --}}
            <div class="text-end mt-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    ← Kembali ke Dashboard
                </a>
</div>
@endsection
