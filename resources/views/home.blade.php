@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-text">
            <h1 class="display-4 fw-bold">
                Makanan Favoritmu,
                Diantar Dalam Hitungan Menit
            </h1>

            <p class="lead">
                Pesan makanan dari restoran terbaik di sekitar Anda.
            </p>

            <a href="#menu" class="btn btn-warning btn-lg">
                Pesan Sekarang
            </a>
        </div>
    </div>
</section>

<!-- SEARCH -->
<div class="container mt-5">

    <div class="card shadow border-0">
        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-5">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari makanan..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-5">
                        <select name="kategori" class="form-select">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach($kategoriList as $k)

                                <option
                                    value="{{ $k->id }}"
                                    {{ request('kategori') == $k->id ? 'selected' : '' }}>

                                    {{ $k->nama_kategori }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success w-100">
                            Cari
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- KATEGORI -->
<div class="container my-5">

    <h2 class="text-center fw-bold mb-4">
        Kategori Makanan
    </h2>

    <div class="row">

        @foreach($kategoriList as $kategori)

        <div class="col-md-3 mb-3">

            <div class="card shadow-sm text-center border-0">

                <div class="card-body">

                    <h5>
                        🍽️ {{ $kategori->nama_kategori }}
                    </h5>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

<!-- PRODUK -->
<div class="container mb-5" id="menu">

    <h2 class="text-center fw-bold mb-4">
        Menu Makanan
    </h2>

    <div class="row">

        @forelse($makanan as $item)

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card food-card h-100">

                @if($item->gambar)
                    <img
                        src="{{ asset('images/'.$item->gambar) }}"
                        class="food-image"
                        alt="{{ $item->nama_makanan }}">
                @endif

                <div class="card-body">

                    <span class="badge bg-success mb-2">
                        {{ \App\Models\KategoriMakanan::find($item->kategori_id)?->nama_kategori }}
                    </span>

                    <h5 class="fw-bold">
                        {{ $item->nama_makanan }}
                    </h5>

                    <p class="text-muted">
                        {{ $item->deskripsi }}
                    </p>

                    <h4 class="text-success fw-bold">
                        Rp {{ number_format($item->harga,0,',','.') }}
                    </h4>

                </div>

                <div class="card-footer bg-white border-0">

                    <a href="/cart/add/{{ $item->id }}"
                       class="btn btn-success w-100">

                        + Keranjang

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-warning">

                Belum ada data makanan.

            </div>

        </div>

        @endforelse

    </div>

    <div class="d-flex justify-content-center">

        {{ $makanan->links() }}

    </div>

</div>

<footer class="bg-dark text-white mt-5">

    <div class="container text-center py-4">

        <h4>🍔 FoodExpress</h4>

        <p>
            Website Food Delivery  
        </p>

        <small>
            © 2026 FoodExpress
        </small>

    </div>

</footer>

@endsection