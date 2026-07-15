<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
</head>
<body>

<h2>Tambah Kategori</h2>

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf

    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori"><br><br>

    <button type="submit">Simpan</button>
</form>

<br>

<a href="{{ route('kategori.index') }}">Kembali</a>

</body>
</html>