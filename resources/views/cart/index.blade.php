@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🛒 Keranjang Belanja</h2>

        <a href="{{ route('makanan.index') }}" class="btn btn-primary">
            + Tambah Makanan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($carts->count() > 0)

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Makanan</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @php
            $total = 0;
        @endphp

        @foreach($carts as $cart)

            @php
                $subtotal = $cart->harga * $cart->qty;
                $total += $subtotal;
            @endphp

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $cart->nama_makanan }}</td>

                <td>
                    Rp {{ number_format($cart->harga,0,',','.') }}
                </td>

                <td>{{ $cart->qty }}</td>

                <td>
                    Rp {{ number_format($subtotal,0,',','.') }}
                </td>

                <td>
                    <a href="{{ route('cart.delete', $cart->id) }}"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus item ini?')">
                        Hapus
                    </a>
                </td>

            </tr>

        @endforeach

        </tbody>

        <tfoot>

            <tr class="table-success">
                <th colspan="5" class="text-end">
                    Total
                </th>

                <th>
                    Rp {{ number_format($total,0,',','.') }}
                </th>
            </tr>

        </tfoot>

    </table>

    <form action="{{ route('checkout') }}" method="POST">

        @csrf

        <div class="mb-3">

            <label class="form-label">
                Metode Pembayaran
            </label>

            <select
                name="metode_pembayaran"
                class="form-control"
                required>

                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="COD">COD</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="DANA">DANA</option>
                <option value="OVO">OVO</option>
                <option value="GoPay">GoPay</option>

            </select>

        </div>

        <button type="submit" class="btn btn-success">
            Checkout
        </button>

    </form>

    @else

    <div class="alert alert-warning text-center">

        <h5>Keranjang masih kosong.</h5>

        <a href="{{ route('makanan.index') }}"
           class="btn btn-primary mt-2">

            Belanja Sekarang

        </a>

    </div>

    @endif

</div>

@endsection