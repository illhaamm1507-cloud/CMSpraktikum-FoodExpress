<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id)
    {
        Cart::create([
            'USER_ID' => Auth::id(),
            'MAKANAN_ID' => $id,
            'QTY' => 1
        ]);

        return redirect('/cart')
            ->with('success', 'Berhasil ditambahkan ke keranjang');
    }

    public function index()
    {
        $carts = DB::table('CARTS')
            ->join('MAKANANS', 'CARTS.MAKANAN_ID', '=', 'MAKANANS.ID')
            ->where('CARTS.USER_ID', Auth::id())
            ->select(
                'CARTS.ID',
                'CARTS.QTY',
                'MAKANANS.NAMA_MAKANAN',
                'MAKANANS.HARGA',
                'MAKANANS.GAMBAR'
            )
            ->get();

        return view('cart.index', compact('carts'));
    }

    // METHOD HAPUS
    public function delete($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect('/cart')
            ->with('success', 'Item berhasil dihapus');
    }

    public function checkout(Request $request)
    {
    $carts = DB::table('CARTS')
        ->join('MAKANANS', 'CARTS.MAKANAN_ID', '=', 'MAKANANS.ID')
        ->where('CARTS.USER_ID', Auth::id())
        ->select(
            'CARTS.QTY',
            'MAKANANS.HARGA'
        )
        ->get();

    if ($carts->count() == 0) {

        return redirect('/cart')
            ->with('error', 'Keranjang masih kosong');

    }

    $total = 0;

    foreach ($carts as $cart) {

        $total += $cart->harga * $cart->qty;

    }

    Pesanan::create([

        'USER_ID' => Auth::id(),

        'NAMA_PEMESAN' => Auth::user()->name,

        'TANGGAL_PESAN' => now(),

        'TOTAL_HARGA' => $total,

        'METODE_PEMBAYARAN' => $request->metode_pembayaran,

        'STATUS' => 'Menunggu',

    ]);

    Cart::where('USER_ID', Auth::id())->delete();

    return redirect()
        ->route('pesanan.saya')
        ->with('success', 'Checkout berhasil.');

    }
}