@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">📅 Jadwal Praktik Dokter Gigi</h4>

    @php
        $hariUrut = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        $grouped = $jadwals->groupBy('hari');
    @endphp

    <div class="row g-4">
        @foreach($hariUrut as $hari)
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-primary"><i class="fas fa-calendar-day me-2"></i>{{ $hari }}</h5>
                    </div>
                    <div class="card-body">
                        @if($grouped->has($hari))
                            @foreach($grouped[$hari]->sortBy('shift') as $j)
                                <div class="border rounded p-2 mb-2">
                                    <div class="fw-bold">{{ $j->nama_dokter }}</div>
                                    <div>
                                        <span class="badge bg-{{ $j->shift === 'Pagi' ? 'info' : ($j->shift === 'Siang' ? 'warning text-dark' : 'secondary') }}">
                                            {{ $j->shift }}
                                        </span>
                                        <span class="ms-2 text-muted">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-muted">Tidak ada jadwal</div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
