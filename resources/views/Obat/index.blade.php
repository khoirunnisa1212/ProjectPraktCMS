@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg w-75">
        <div class="card-body text-center">
            <h1 class="card-title">Selamat Datang di <strong>Klinik Gigi Sehat</strong></h1>
            <p class="card-text lead">Kami siap membantu Anda menjaga kesehatan gigi dan mulut dengan sepenuh hati.</p>

            <hr>

            <blockquote class="blockquote">
                <p class="mb-0">Berlayar perahu di tengah laut,</p>
                <p class="mb-0">Angin sepoi membuat tenang.</p>
                <p class="mb-0">Periksa gigi jangan ditakut,</p>
                <p class="mb-0">Di klinik sehat, senyum pun terang.</p>
            </blockquote>

            <div class="mt-4">
            @if(auth()->check() && !auth()->user()->sudah_daftar)
            <a href="{{ route('form.pendaftaran') }}" class="btn btn-outline-primary m-2">
                    📝 Pendaftaran Pasien
                </a>
                @endif
                <a href="{{ route('form.obat') }}" class="btn btn-outline-success m-2">
                    🚶‍♂️🚶‍♀️ Ambil Antrian
                </a>
                <a href="{{ route('obat.jadwal') }}" class="btn btn-outline-info m-2">
                    📅 Jadwal Dokter
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
