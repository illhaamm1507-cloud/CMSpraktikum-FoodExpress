<!DOCTYPE html>

<html>
<head>
    <title>Edit Makanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

```
<h2>Edit Makanan</h2>

<form action="{{ route('makanan.update', $makanan->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Makanan</label>
        <input type="text"
               name="nama_makanan"
               value="{{ $makanan->nama_makanan }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Kategori</label>

        <select name="kategori_id" class="form-control" required>

            @foreach($kategori as $k)

                <option value="{{ $k->id }}"
                    {{ $makanan->kategori_id == $k->id ? 'selected' : '' }}>

                    {{ $k->nama_kategori }}

                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number"
               name="harga"
               value="{{ $makanan->harga }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number"
               name="stok"
               value="{{ $makanan->stok }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>

        <textarea
            name="deskripsi"
            class="form-control"
            rows="4">{{ $makanan->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label>Gambar Baru (Opsional)</label>

        <input type="file"
               name="gambar"
               class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Update
    </button>

    <a href="{{ route('makanan.index') }}"
       class="btn btn-secondary">
        Kembali
    </a>

</form>
```

</div>

</body>
</html>
