@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">
        Pesanan Saya
    </h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($pesanans->count())

    <table class="table table-bordered table-striped">

        <thead class="table-success">

        <tr>
            <th>No</th>
            <th>Nama Pemesan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Metode</th>
            <th>Status</th>
        </tr>

        </thead>

        <tbody>

        @foreach($pesanans as $pesanan)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $pesanan->nama_pemesan }}</td>

            <td>
                {{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d-m-Y') }}
            </td>

            <td>
                Rp {{ number_format($pesanan->total_harga,0,',','.') }}
            </td>

            <td>
                {{ $pesanan->metode_pembayaran }}
            </td>

            <td>
    @if($pesanan->status == 'Menunggu')
        <span class="badge bg-warning text-dark">
            Menunggu
        </span>
    @elseif($pesanan->status == 'Diproses')
        <span class="badge bg-primary">
            Diproses
        </span>
    @elseif($pesanan->status == 'Selesai')
        <span class="badge bg-success">
            Selesai
        </span>
    @else
        <span class="badge bg-danger">
            Dibatalkan
        </span>
    @endif
</td>
        </tr>

        @endforeach

        </tbody>

    </table>

    @else

    <div class="alert alert-warning">
        Anda belum memiliki pesanan.
    </div>

    @endif

</div>

@endsection