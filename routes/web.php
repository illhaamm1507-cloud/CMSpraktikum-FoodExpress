<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Makanan;
use App\Models\KategoriMakanan;
use App\Models\Komentar;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriMakananController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KomentarController;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $search = request('search');
    $kategori = request('kategori');

    $kategoriList = KategoriMakanan::all();

    $komentars = Komentar::with('user')
        ->latest()
        ->get();

    $makanan = Makanan::with('kategori')
        ->when($search, function ($query) use ($search) {
            $query->where('nama_makanan', 'like', '%' . $search . '%');
        })
        ->when($kategori, function ($query) use ($kategori) {
            $query->where('kategori_id', $kategori);
        })
        ->latest()
        ->paginate(6);

    return view('home', compact(
        'makanan',
        'kategoriList',
        'komentars'
    ));

})->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    Route::get('/home', function () {
        return redirect('/');
    });

});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function () {

    Route::resource('kategori', KategoriMakananController::class);

    Route::resource('pesanan', PesananController::class);

});

/*
|--------------------------------------------------------------------------
| CUSTOMER & ADMIN (LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Makanan
    |--------------------------------------------------------------------------
    */

    Route::resource('makanan', MakananController::class);

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', [CartController::class,'index']);

    Route::get('/cart/add/{id}', [CartController::class,'add']);

    Route::post('/cart/checkout', [CartController::class,'checkout'])
        ->name('checkout');

    Route::get('/cart/delete/{id}', [CartController::class,'delete'])
        ->name('cart.delete');

    /*
    |--------------------------------------------------------------------------
    | Komentar
    |--------------------------------------------------------------------------
    */

    Route::post('/komentar',[KomentarController::class,'store']);

    /*
    |--------------------------------------------------------------------------
    | Pesanan Customer
    |--------------------------------------------------------------------------
    */

    Route::get('/pesanan-saya',
        [PesananController::class,'pesananSaya'])
        ->name('pesanan.saya');

});

/*
|--------------------------------------------------------------------------
| TEST ORACLE
|--------------------------------------------------------------------------
*/

Route::get('/oracle-test', function () {

    try {

        DB::connection('oracle')->getPdo();

        return "Koneksi Oracle Berhasil";

    } catch (\Exception $e) {

        return $e->getMessage();

    }

});

/*
|--------------------------------------------------------------------------
| TEST DATA
|--------------------------------------------------------------------------
*/

Route::get('/cek-makanan', function () {

    return Makanan::all();

});

Route::get('/test-session', function () {

    Auth::loginUsingId(1);

    return [
        'auth' => Auth::check(),
        'user' => Auth::user(),
        'session_id' => session()->getId(),
        'cookie_name' => config('session.cookie'),
    ];

});

Route::get('/cek-auth', function () {

    return [
        'auth' => Auth::check(),
        'user' => Auth::user(),
        'session_id' => session()->getId(),
        'session' => session()->all(),
    ];

});