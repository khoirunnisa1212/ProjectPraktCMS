@extends('layouts.app')

@section('content')
<div class="container mt-3 mb-3">
    <h4 class="mb-3 fw-bold">Riwayat Pemeriksaan Pasien</h4>

    <form action="{{ route('admin.pendaftar.riwayat.store', $pendaftar->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="penyakit" class="form-label">Penyakit</label>
            <input type="text" name="penyakit" id="penyakit" class="form-control" placeholder="Contoh: Demam Berdarah" required>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3" placeholder="Tuliskan hasil diagnosa dokter..." required></textarea>
        </div>

        <div class="mb-3">
            <label for="obat" class="form-label">Obat yang Diberikan <small class="text-muted">(opsional)</small></label>
            <input type="text" name="obat" id="obat" class="form-control" placeholder="Contoh: Paracetamol">
        </div>

        <div class="mb-3">
            <label for="tanggal_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
            <input type="date" name="tanggal_pemeriksaan" id="tanggal_pemeriksaan" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Batal</a>
            <button type="submit" class="btn btn-success">Simpan Riwayat</button>
        </div>
    </form>
</div>
@endsection
