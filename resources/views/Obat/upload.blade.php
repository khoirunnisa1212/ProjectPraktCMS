<!DOCTYPE html>
<html>
<head>
 <title>Upload Gambar</title>
</head>
<body>
 <h2>Form Upload Gambar</h2>
 @if (session('success'))
 <p style="color: green;">{{ session('success') }}</p>
 @endif
 <!-- Form Upload -->
<form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
 @csrf
 <label>Judul:</label><br>
 <input type="text" name="title"><br><br>
 <label>Pilih Gambar:</label><br>
 <input type="file" name="image"><br><br>
 <button type="submit">Upload</button>
</form>
<!-- Preview Gambar -->
@if (isset($image))
 <h3>Gambar yang baru diupload:</h3>
 <p><strong>{{ $image->title }}</strong></p>
 <img src="{{ asset('storage/' . $image->image_path) }}" width="200">

  <!-- Tombol Hapus -->
   <br><br>
        <form action="{{ route('image.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="color:red;">Hapus Gambar</button>
        </form>
@endif
<br>
    <a href="{{ route('obat.index') }}">
    <button type="button">Kembali ke Menu Utama</button>
</a>
</body>
</html>