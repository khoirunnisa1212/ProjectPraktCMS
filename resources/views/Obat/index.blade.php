<!DOCTYPE html>
<html>
<head>
    <title>Daftar Obat</title>
</head>
<body>
    <h1>Daftar Obat</h1>
    <ul>
        @foreach ($obats as $obat)
            <li>
                <strong>{{ $obat['title'] }}</strong><br>
                <a href="{{ url('/obats/' . $obat['id']) }}">Lihat Detail</a>
            </li>
            <hr>
        @endforeach
    </ul>
</body>
</html>

