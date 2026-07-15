<!DOCTYPE html>
<html>
<head>
    <title>Tambah Makanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Tambah Makanan</h2>

    <form action="{{ route('makanan.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label>Nama Makanan</label>
            <input type="text" name="nama_makanan" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori</label>

            <select name="kategori_id" class="form-control">

                @foreach($kategori as $k)

                <option value="{{ $k->id }}">
                    {{ $k->nama_kategori }}
                </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control">
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">
            Simpan
        </button>

    </form>

</div>

</body>
</html>