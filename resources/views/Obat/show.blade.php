@extends('layouts.app')

@section('content')

<div class="container mt-4">

    @php
        $pendaftarSession = session('pendaftar');
    @endphp

    {{-- Jika mode tampilan adalah pendaftaran --}}
    @if(session('type') == 'pendaftaran')

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form jika belum ada session pendaftar --}}
        @if(!$pendaftarSession)
            <h2 class="mb-4 fw-bold"><i class="fas fa-user-plus me-2"></i>Formulir Pendaftaran Pasien</h2>

            <form action="{{ route('submit.pendaftaran') }}" method="POST" class="card shadow-sm p-4 border-0">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="bb" class="form-label">Berat Badan (kg)</label>
                        <input type="number" name="bb" id="bb" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label for="tb" class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" name="tb" id="tb" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="telepon" class="form-label">No Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i> Daftar
                    </button>
                </div>
            </form>
        @else
            {{-- Jika sudah ada data di session --}}
            <div class="container mt-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> Data pendaftar berhasil disimpan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>

                <div class="card shadow animate__animated animate__fadeIn">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user me-2"></i>Data Pendaftar</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th style="width: 40%;">ID Pendaftar</th>
                                <td>{{ $pendaftarSession->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $pendaftarSession->nama }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <!-- Tombol Hapus -->
                <form action="{{ route('pendaftar.destroy', $pendaftarSession->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus Data
                    </button>
                </form>

                <!-- Tombol Ambil Antrian -->
                <a href="{{ route('form.obat') }}" class="btn btn-info">
                    <i class="fas fa-clipboard-list me-1"></i> Ambil Antrian
                </a>
            </div>
        @endif

    @elseif(session('type') == 'obat')

        {{-- Form antrian obat --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h2 class="mb-4 fw-bold"><i class="fas fa-notes-medical me-2"></i>Antrian Kunjungan</h2>

        <form action="{{ route('obat.submit') }}" method="POST" class="card p-4 shadow-sm border-0">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="id_pendaftar" class="form-label">ID Pendaftar</label>
                    <input type="text" name="id_pendaftar" id="id_pendaftar" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-search me-1"></i> Lihat Antrian
                </button>
            </div>
        </form>

        @if(session('obat'))
            <hr>
            <h4 class="mt-4">Kamu mendapat :</h4>
            <div class="d-flex justify-content-left">
                <div class="text-center p-4 border rounded-3 shadow-sm bg-light" style="max-width: 350px;">
                    <div class="text-muted mb-2">Nomor Antrian</div>
                    <div class="fs-1 fw-bold text-primary border rounded-2 py-2 px-3">
                        #{{ session('obat')->id }}
                    </div>
                    <hr>
                    <div><strong>ID Pendaftar:</strong> {{ session('obat')->Id_Pendaftar }}</div>
                    <div><strong>Nama:</strong> {{ session('obat')->nama }}</div>
                </div>
            </div>
        @endif

    @endif

    <div class="mt-4 mb-3">
            <a href="{{ route('obat.index', ['clear' => true]) }}" class="btn btn-secondary">
                <i class="fas fa-home me-1"></i> Kembali ke Menu Utama
            </a>
    </div>
</div>

{{-- Modal konfirmasi hapus --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteForm;
    function confirmDelete(event) {
        event.preventDefault();
        deleteForm = event.target;
        const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        deleteForm.submit();
    });
</script>

@endsection
