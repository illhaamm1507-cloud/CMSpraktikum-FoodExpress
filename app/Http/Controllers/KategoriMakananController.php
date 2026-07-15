<?php

namespace App\Http\Controllers;

use App\Models\KategoriMakanan;
use Illuminate\Http\Request;

class KategoriMakananController extends Controller
{
    public function index()
    {
        $kategori = KategoriMakanan::all();

        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KategoriMakanan::create([
            'NAMA_KATEGORI' => $request->nama_kategori
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = KategoriMakanan::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KategoriMakanan::where('ID', $id)
            ->update([
                'NAMA_KATEGORI' => $request->nama_kategori
            ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        KategoriMakanan::where('ID', $id)->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
