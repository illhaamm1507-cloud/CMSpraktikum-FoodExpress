@extends('layouts.app')

@section('content')

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Data Pesanan</h2>

    <a href="{{ route('pesanan.create') }}"
       class="btn btn-success">
        + Tambah Pesanan
    </a>

</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-hover">

    <thead class="table-dark">

<tr>

    <th>No</th>
    <th>Nama Akun</th>
    <th>Nama Pemesan</th>
    <th>Tanggal</th>
    <th>Total Harga</th>
    <th>Pembayaran</th>
    <th>Status</th>
    <th width="170">Aksi</th>

</tr>

</thead>

    <tbody>

    <tbody>

@foreach($pesanans as $pesanan)

<tr>

    <td>{{ $loop->iteration }}</td>

    
    <td>
        {{ optional($pesanan->user)->name }}
    </td>
     

    <td>
        {{ $pesanan->nama_pemesan }}
    </td>

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

        @if($pesanan->status=='Menunggu')

            <span class="badge bg-warning text-dark">
                Menunggu
            </span>

        @elseif($pesanan->status=='Diproses')

            <span class="badge bg-primary">
                Diproses
            </span>

        @elseif($pesanan->status=='Dikirim')

            <span class="badge bg-info text-dark">
                 Dikirim
            </span>

        @elseif($pesanan->status=='Selesai')

            <span class="badge bg-success">
                Selesai
            </span>

        @endif

    </td>

    <td>

        <a href="{{ route('pesanan.edit',$pesanan->id) }}"
           class="btn btn-warning btn-sm">
            Edit
        </a>

        <form
            action="{{ route('pesanan.destroy',$pesanan->id) }}"
            method="POST"
            class="d-inline">

            @csrf
            @method('DELETE')

            <button
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin ingin menghapus pesanan?')">

                Hapus

            </button>

        </form>

    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection