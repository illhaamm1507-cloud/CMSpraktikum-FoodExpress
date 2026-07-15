<!DOCTYPE html>
<html>
<head>
    <title>Data Makanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">
            🍔 Food Delivery
        </span>

        <a href="{{ route('makanan.create') }}"
           class="btn btn-warning">
            + Tambah Makanan
        </a>
    </div>
</nav>

<div class="container mt-4">

    <h2 class="mb-4">Daftar Makanan</h2>

    <div class="row">
        

        @foreach($makanan as $m)

        <div class="col-md-4 mb-4">

            <div class="card shadow h-100">

                @if($m->gambar)
                <img src="{{ asset('images/'.$m->gambar) }}"
                     class="card-img-top"
                     style="height:250px; object-fit:cover;">
                @endif

                <div class="card-body">

                    <h4>{{ $m->nama_makanan }}</h4>

                    <p>
                        Kategori:
                       {{ optional($m->kategori)->nama_kategori ?? '-' }}
                    </p>

                    <p>
                        {{ $m->deskripsi }}
                    </p>

                    <p>
                        Stok:
                        <b>{{ $m->stok }}</b>
                    </p>

                    <h5 class="text-success">
                        Rp {{ number_format($m->harga) }}
                    </h5>

                    <div class="mt-3">

    {{-- Tombol Tambah Keranjang --}}
    <a href="{{ url('/cart/add/'.$m->id) }}"
       class="btn btn-primary btn-sm">
        🛒 Tambah Keranjang
    </a>

    {{-- Tombol Edit --}}
    <a href="{{ route('makanan.edit', $m->id) }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    {{-- Tombol Hapus --}}
    <form action="{{ route('makanan.destroy', $m->id) }}"
          method="POST"
          style="display:inline;">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Hapus makanan ini?')">
            Hapus
        </button>

    </form>

</div>

                </div>

            </div>

        </div>
        

        @endforeach

    </div>

</div>

</body>
</html>