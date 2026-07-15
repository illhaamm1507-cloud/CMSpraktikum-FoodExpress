<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ==========================
    // Admin : Semua Pesanan
    // ==========================
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $pesanans = Pesanan::with('user')
            ->orderBy('ID', 'desc')
            ->get();

        return view('pesanan.index', compact('pesanans'));
    }

    // ==========================
    // Customer : Pesanan Saya
    // ==========================
    public function pesananSaya()
    {
        $pesanans = Pesanan::where('USER_ID', auth()->id())
            ->orderBy('ID', 'desc')
            ->get();

        return view('pesanan.saya', compact('pesanans'));
    }

    // ==========================
    // Form Tambah
    // ==========================
    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $users = User::orderBy('NAME')->get();

        return view('pesanan.create', compact('users'));
    }

    // ==========================
    // Simpan
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama_pemesan' => 'required|string|max:100',
            'tanggal_pesan' => 'required|date',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'status' => 'required',
        ]);

        Pesanan::create([
            'USER_ID' => $request->user_id,
            'NAMA_PEMESAN' => $request->nama_pemesan,
            'TANGGAL_PESAN' => $request->tanggal_pesan,
            'TOTAL_HARGA' => $request->total_harga,
            'METODE_PEMBAYARAN' => $request->metode_pembayaran,
            'STATUS' => $request->status,
        ]);

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    // ==========================
    // Detail
    // ==========================
    public function show($id)
    {
        $pesanan = Pesanan::with('user')->findOrFail($id);

        if (!Auth::user()->isAdmin() && $pesanan->USER_ID != Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('pesanan.show', compact('pesanan'));
    }

    // ==========================
    // Form Edit
    // ==========================
    public function edit($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $pesanan = Pesanan::findOrFail($id);

        $users = User::orderBy('NAME')->get();

        return view('pesanan.edit', compact('pesanan', 'users'));
    }

    // ==========================
    // Update
    // ==========================
    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'user_id' => 'required',
            'nama_pemesan' => 'required|string|max:100',
            'tanggal_pesan' => 'required|date',
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required',
            'status' => 'required',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update([
            'USER_ID' => $request->user_id,
            'NAMA_PEMESAN' => $request->nama_pemesan,
            'TANGGAL_PESAN' => $request->tanggal_pesan,
            'TOTAL_HARGA' => $request->total_harga,
            'METODE_PEMBAYARAN' => $request->metode_pembayaran,
            'STATUS' => $request->status,
        ]);

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    // ==========================
    // Hapus
    // ==========================
    public function destroy($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->delete();

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}