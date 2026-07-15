@extends('layouts.app')

@section('content')

<div class="container mt-4">

<div class="card">

    <div class="card-header">
        <h3>Edit Kategori Makanan</h3>
    </div>

    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="form-control"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                    required>

            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('kategori.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

</div>

@endsection
