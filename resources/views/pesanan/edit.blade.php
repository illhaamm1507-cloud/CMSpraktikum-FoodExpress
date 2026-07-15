@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark">
            <h3 class="mb-0">Edit Pesanan</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- User --}}
                <div class="mb-3">

                    <label class="form-label">
                        User
                    </label>

                    <select
                        name="user_id"
                        class="form-control"
                        required>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}"
                                {{ $pesanan->user_id == $user->id ? 'selected' : '' }}>

                                {{ $user->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Nama Pemesan --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nama Pemesan
                    </label>

                    <input
                        type="text"
                        name="nama_pemesan"
                        class="form-control"
                        value="{{ $pesanan->nama_pemesan }}"
                        required>

                </div>

                {{-- Tanggal Pesan --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tanggal Pesan
                    </label>

                    <input
                        type="date"
                        name="tanggal_pesan"
                        class="form-control"
                        value="{{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('Y-m-d') }}"
                        required>

                </div>

                {{-- Total Harga --}}
                <div class="mb-3">

                    <label class="form-label">
                        Total Harga
                    </label>

                    <input
                        type="number"
                        name="total_harga"
                        class="form-control"
                        value="{{ $pesanan->total_harga }}"
                        required>

                </div>

                {{-- Metode Pembayaran --}}
                <div class="mb-3">

                    <label class="form-label">
                        Metode Pembayaran
                    </label>

                    <select
                        name="metode_pembayaran"
                        class="form-control"
                        required>

                        <option value="COD"
                            {{ $pesanan->metode_pembayaran=='COD' ? 'selected' : '' }}>
                            COD
                        </option>

                        <option value="Transfer Bank"
                            {{ $pesanan->metode_pembayaran=='Transfer Bank' ? 'selected' : '' }}>
                            Transfer Bank
                        </option>

                        <option value="DANA"
                            {{ $pesanan->metode_pembayaran=='DANA' ? 'selected' : '' }}>
                            DANA
                        </option>

                        <option value="OVO"
                            {{ $pesanan->metode_pembayaran=='OVO' ? 'selected' : '' }}>
                            OVO
                        </option>

                        <option value="GoPay"
                            {{ $pesanan->metode_pembayaran=='GoPay' ? 'selected' : '' }}>
                            GoPay
                        </option>

                    </select>

                </div>

                {{-- Status --}}
                <div class="mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-control">

                        <option value="Menunggu"
                            {{ $pesanan->status=='Menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>

                        <option value="Diproses"
                            {{ $pesanan->status=='Diproses' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="Dikirim"
                            {{ $pesanan->status=='Dikirim' ? 'selected' : '' }}>
                            Dikirim
                        </option>

                        <option value="Selesai"
                            {{ $pesanan->status=='Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                    </select>

                </div>

                <button class="btn btn-warning">
                    Update
                </button>

                <a href="{{ route('pesanan.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection