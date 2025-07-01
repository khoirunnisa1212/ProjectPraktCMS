@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Data Pendaftar</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('pendaftar.update', $data->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $data->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Berat Badan (kg)</label>
            <input type="number" name="bb" class="form-control" value="{{ old('bb', $data->bb) }}" required>
        </div>

        <div class="mb-3">
            <label>Tinggi Badan (cm)</label>
            <input type="number" name="tb" class="form-control" value="{{ old('tb', $data->tb) }}" required>
        </div>

        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $data->telepon) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $data->email) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('obat.cek', ['id' => $data->id]) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
