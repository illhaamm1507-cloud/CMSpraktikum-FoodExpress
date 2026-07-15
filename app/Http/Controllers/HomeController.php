<?php

namespace App\Http\Controllers;

use App\Models\KategoriMakanan;
use App\Models\Makanan;
use App\Models\Pesanan;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalKategori = KategoriMakanan::count();
        $totalMakanan = Makanan::count();
        $totalPesanan = Pesanan::count();
        $totalUser = User::count();

        $pesananMenunggu = Pesanan::where('status', 'Menunggu')->count();

        $pesananDiproses = Pesanan::where('status', 'Diproses')->count();

        $pesananDikirim = Pesanan::where('status', 'Dikirim')->count();

        $pesananSelesai = Pesanan::where('status', 'Selesai')->count();

        return view('dashboard', compact(
            'totalKategori',
            'totalMakanan',
            'totalPesanan',
            'totalUser',
            'pesananMenunggu',
            'pesananDiproses',
            'pesananDikirim',
            'pesananSelesai'
        ));
    }
}
