@extends('layouts.app')

@section('content')

<div class="container">


<h2 class="mb-4">
    Dashboard Admin
</h2>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h5>Total Kategori</h5>
                <h2>{{ $totalKategori }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h5>Total Makanan</h5>
                <h2>{{ $totalMakanan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark shadow">
            <div class="card-body">
                <h5>Total Pesanan</h5>
                <h2>{{ $totalPesanan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h5>Total User</h5>
                <h2>{{ $totalUser }}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-4">


<div class="col-md-3 mb-3">
    <div class="card border-secondary">
        <div class="card-body text-center">
            <h5>Menunggu</h5>
            <h2>{{ $pesananMenunggu }}</h2>
        </div>
    </div>
</div>

<div class="col-md-3 mb-3">
    <div class="card border-warning">
        <div class="card-body text-center">
            <h5>Diproses</h5>
            <h2>{{ $pesananDiproses }}</h2>
        </div>
    </div>
</div>

<div class="col-md-3 mb-3">
    <div class="card border-primary">
        <div class="card-body text-center">
            <h5>Dikirim</h5>
            <h2>{{ $pesananDikirim }}</h2>
        </div>
    </div>
</div>

<div class="col-md-3 mb-3">
    <div class="card border-success">
        <div class="card-body text-center">
            <h5>Selesai</h5>
            <h2>{{ $pesananSelesai }}</h2>
        </div>
    </div>
</div>


</div>


</div>

</div>

@endsection
