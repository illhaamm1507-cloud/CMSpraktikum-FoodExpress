<!DOCTYPE html>

<html>
<head>
    <title>Kategori Makanan</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">


</head>
<body>

<div class="container mt-4">


<h2>Data Kategori Makanan</h2>

<a href="{{ route('kategori.create') }}"
   class="btn btn-primary mb-3">
    + Tambah Kategori
</a>

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

<table class="table table-bordered">

    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th width="200">Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($kategori as $k)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $k->nama_kategori }}</td>

            <td>

                <a href="{{ route('kategori.edit', $k->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('kategori.destroy', $k->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data ini?')">
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>
            <td colspan="3" class="text-center">
                Belum ada data kategori
            </td>
        </tr>

    @endforelse

    </tbody>

</table>


</div>

</body>
</html>
