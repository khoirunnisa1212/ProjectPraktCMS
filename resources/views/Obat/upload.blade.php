@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">🖼️ Upload Dokumen</h4>
        </div>
        <div class="card-body">

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form Upload --}}
            <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Jenis Dokumen (KTP / KK)</label>
                    <input type="text" name="title" class="form-control" placeholder="Contoh: KTP/KK" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Gambar</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">📤 Upload</button>
            </form>

            {{-- Preview jika ada --}}
            @if (isset($image))
                <hr>
                <h7 class="mt-4">📄 Gambar Terakhir yang Diunggah:</h7>
                <p class="text-center"><strong>{{ $image->title }}</strong></p>
                <div class="text-center mt-3">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded shadow-sm mx-auto d-block" style="max-height: 250px;">
                </div>

                <form action="{{ route('image.destroy', $image->id) }}" method="POST" class="mt-3" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">🗑️ Hapus Gambar</button>
                </form>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('obat.index') }}" class="btn btn-secondary">← Kembali ke Menu Utama</a>
            </div>
        </div>
    </div>
</div>
@endsection
