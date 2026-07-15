@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Data Pesanan
    </h2>

    <a href="/pesanan/create"
       class="btn btn-success mb-3">
       Tambah Pesanan
    </a>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>No</th>
                <th>User</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
            </tr>

        </thead>

        <tbody>

            @foreach($pesanans as $pesanan)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $pesanan->user->name }}
                </td>

                <td>
                    {{ $pesanan->tanggal_pesan }}
                </td>

                <td>
                    Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                </td>

                <td>
                    {{ $pesanan->status }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection