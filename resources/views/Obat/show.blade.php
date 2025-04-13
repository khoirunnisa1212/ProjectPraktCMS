<!DOCTYPE html>
<html>
<head>
    <title>Detail Obat</title>
</head>
<body>
    <h1>{{ $obat['title'] }}</h1>

    @if ($obat['id'] == 1)
        {{-- Konten untuk Nama Obat --}}
        <ul>
            <li>ID Obat: 0001</li>
            <li>Nama Obat: Paracetamol</li>
            <li>Tanggal Kedaluwarsa: 2025-12-31</li>
        </ul>
        <ul>
            <li>ID Obat: 0002</li>
            <li>Nama Obat: Obat Kumur</li>
            <li>Tanggal Kedaluwarsa: 2026-12-01</li>
        </ul>
        <ul>
            <li>ID Obat: 0003</li>
            <li>Nama Obat: Hidrogen peroksida</li>
            <li>Tanggal Kedaluwarsa: 2027-10-21</li>
        </ul>
        <ul>
            <li>ID Obat: 0004</li>
            <li>Nama Obat: Ibuprofen</li>
            <li>Tanggal Kedaluwarsa: 2026-06-06</li>
        </ul>
        <ul>
            <li>ID Obat: 0005</li>
            <li>Nama Obat: Asam mefenamat</li>
            <li>Tanggal Kedaluwarsa: 2027-08-11</li>
        </ul>
        <ul>
            <li>ID Obat: 0006</li>
            <li>Nama Obat: Ponstan FCT</li>
            <li>Tanggal Kedaluwarsa: 2025-10-02</li>
        </ul>

    @elseif ($obat['id'] == 2)
        {{-- Konten untuk Jenis Obat --}}
        <h3>Obat Bebas</h3>
        <ul>
            <li>Paracetamol</li>
            <li>Obat Kumur</li>
        </ul>

        <h3>Obat Bebas Terbatas</h3>
        <ul>
            <li>Hidrogen peroksida</li>
            <li>Ibuprofen</li>
        </ul>

        <h3>Obat Keras</h3>
        <ul>
            <li>Asam mefenamat</li>
            <li>Ponstan FCT</li>
        </ul>

        @elseif ($obat['id'] == 3)
        @if (session('success'))
            <p style="color: green;"><strong>{{ session('success') }}</strong></p>
        @else
            <form method="POST" action="{{ url('/obats/' . $obat['id'] . '/ulasan') }}">
                @csrf
                <label for="nama">Nama:</label><br>
                <input type="text" id="nama" name="nama"><br><br>

                <label for="ulasan">Ulasan:</label><br>
                <textarea id="ulasan" name="ulasan" rows="4" cols="50"></textarea><br><br>

                <button type="submit">Kirim</button>
            </form>
        @endif
    @endif

    <br>
    <a href="{{ url('/obats') }}">← Kembali ke Daftar</a>
</body>
</html>
