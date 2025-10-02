<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (Dapat diakses oleh siapa saja, termasuk tamu)
|--------------------------------------------------------------------------
|
| Rute ini tidak memerlukan login.
|
*/
Route::get('/', function () {
    $popularBooks = \App\Models\Book::where('is_popular', true)->latest()->take(4)->get();
    return view('beranda', compact('popularBooks'));
})->name('beranda');

Route::get('/buku', function () {
    $books = \App\Models\Book::latest()->paginate(8);
    return view('daftarbuku', compact('books'));
})->name('buku.index');

Route::get('/buku/{book}', [PageController::class, 'showBookDetail'])->name('buku.detail');


/*
|--------------------------------------------------------------------------
| RUTE AUTENTIKASI (Untuk Tamu / Guest)
|--------------------------------------------------------------------------
|
| Rute ini hanya dapat diakses oleh pengguna yang BELUM login.
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


/*
|--------------------------------------------------------------------------
| RUTE PENGGUNA (Wajib Login)
|--------------------------------------------------------------------------
|
| Rute ini hanya dapat diakses oleh pengguna yang SUDAH login.
|
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Keranjang & Peminjaman
    Route::get('/keranjang', [BorrowingController::class, 'showCart'])->name('keranjang.show');
    Route::post('/keranjang/tambah/{book}', [BorrowingController::class, 'addToCart'])->name('keranjang.tambah');
    Route::post('/keranjang/hapus/{book}', [BorrowingController::class, 'removeFromCart'])->name('keranjang.hapus');
    Route::post('/keranjang/submit', [BorrowingController::class, 'submitRequest'])->name('keranjang.submit');
    Route::get('/peminjaman-sukses', function () {
        return view('peminjaman_sukses');
    })->name('peminjaman.sukses');
});


/*
|--------------------------------------------------------------------------
| RUTE ADMIN (Wajib Login & Sebaiknya Role Admin)
|--------------------------------------------------------------------------
|
| Rute ini hanya dapat diakses oleh pengguna yang sudah login.
| Untuk keamanan lebih, nanti bisa ditambahkan middleware role admin.
|
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // Memberi nama pada route dashboard admin

    // Route untuk Manajemen Buku (CRUD)
    Route::resource('books', BookController::class);

    // Route untuk Verifikasi Peminjaman
    Route::get('/borrowing', [AdminBorrowingController::class, 'index'])->name('borrowing.index');
    Route::patch('/borrowing/{peminjaman}/verify', [AdminBorrowingController::class, 'verify'])->name('borrowing.verify');
});