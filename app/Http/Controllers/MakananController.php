<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\KategoriMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MakananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    |--------------------------------------------------------------------------
    | Daftar Makanan
    | Customer & Admin
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $makanan = Makanan::with('kategori')->get();

        return view('makanan.index', compact('makanan'));
    }

    /*
    |--------------------------------------------------------------------------
    | Form Tambah
    | Admin Only
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $kategori = KategoriMakanan::all();

        return view('makanan.create', compact('kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan
    | Admin Only
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'kategori_id' => 'required',
            'nama_makanan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $gambar = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $gambar);
        }

        DB::table('MAKANANS')->insert([
            'KATEGORI_ID'  => $request->kategori_id,
            'NAMA_MAKANAN' => $request->nama_makanan,
            'HARGA'        => $request->harga,
            'GAMBAR'       => $gambar,
            'DESKRIPSI'    => $request->deskripsi,
            'STOK'         => $request->stok,
            'CREATED_AT'   => now(),
            'UPDATED_AT'   => now(),
        ]);

        return redirect()
            ->route('makanan.index')
            ->with('success', 'Makanan berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | Detail
    | Customer & Admin
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $makanan = Makanan::findOrFail($id);

        return view('makanan.show', compact('makanan'));
    }

    /*
    |--------------------------------------------------------------------------
    | Form Edit
    | Admin Only
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $makanan = Makanan::findOrFail($id);

        $kategori = KategoriMakanan::all();

        return view('makanan.edit', compact('makanan', 'kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    | Admin Only
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'kategori_id' => 'required',
            'nama_makanan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $data = [
            'KATEGORI_ID'  => $request->kategori_id,
            'NAMA_MAKANAN' => $request->nama_makanan,
            'HARGA'        => $request->harga,
            'DESKRIPSI'    => $request->deskripsi,
            'STOK'         => $request->stok,
            'UPDATED_AT'   => now(),
        ];

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $gambar = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $gambar);

            $data['GAMBAR'] = $gambar;
        }

        DB::table('MAKANANS')
            ->where('ID', $id)
            ->update($data);

        return redirect()
            ->route('makanan.index')
            ->with('success', 'Makanan berhasil diupdate.');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus
    | Admin Only
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        DB::table('MAKANANS')
            ->where('ID', $id)
            ->delete();

        return redirect()
            ->route('makanan.index')
            ->with('success', 'Makanan berhasil dihapus.');
    }
}