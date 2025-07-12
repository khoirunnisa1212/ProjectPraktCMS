@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">📂 Riwayat Upload Dokumen</h3>

    @if($images->isEmpty())
        <div class="alert alert-info">Belum ada dokumen yang diupload.</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($images as $img)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="card-img-top" alt="{{ $img->title }}" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $img->title }}</h5>
                            <p class="card-text"><small class="text-muted">Diunggah: {{ $img->created_at->format('d-m-Y H:i') }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
{{-- Tombol kembali --}}
    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>
</div>
@endsection
