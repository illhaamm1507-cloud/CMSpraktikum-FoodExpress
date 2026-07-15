@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Tambah Pesanan</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('pesanan.store') }}" method="POST">

                @csrf

                {{-- User --}}
                <div class="mb-3">
                    <label class="form-label">
                        User
                    </label>

                    <select
                        name="user_id"
                        class="form-control"
                        required>

                        <option value="">-- Pilih User --</option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}">
                                {{ $pesanan->user->NAME ?? '-' }}
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
                        placeholder="Masukkan nama pemesan"
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
                        placeholder="Masukkan total harga"
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

                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="COD">COD</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="DANA">DANA</option>
                        <option value="OVO">OVO</option>
                        <option value="GoPay">GoPay</option>

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

                        <option value="Menunggu">Menunggu</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Dikirim">Dikirim</option>
                        <option value="Selesai">Selesai</option>

                    </select>

                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
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