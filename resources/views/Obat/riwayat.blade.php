@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">🩺 Riwayat Pemeriksaan - a.n. {{ Auth::user()->nama }}</h5>
        </div>

        <div class="card-body">
            @if($riwayats->isEmpty())
                <div class="alert alert-info mb-0">
                    Belum ada riwayat pemeriksaan yang tercatat.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Penyakit</th>
                                <th>Diagnosa</th>
                                <th>Obat</th>
                                <th>Tanggal Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayats as $r)
                                <tr>
                                    <td>{{ $r->penyakit }}</td>
                                    <td class="text-start">{{ $r->diagnosa }}</td>
                                    <td>{{ $r->obat ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal_pemeriksaan)->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
