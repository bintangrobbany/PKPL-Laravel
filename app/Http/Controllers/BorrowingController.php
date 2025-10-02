<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{

    // Fungsi untuk menambahkan buku ke keranjang (Session)
    public function addToCart(Request $request, Book $book)
    {
        // Ambil keranjang dari session, atau buat array kosong jika belum ada
        $cart = session()->get('cart', []);

        // Cek apakah buku sudah ada di keranjang
        if (isset($cart[$book->id])) {
            return back()->with('error', 'Buku ini sudah ada di keranjang Anda!');
        }

        // Tambahkan buku ke keranjang
        $cart[$book->id] = [
            "durasi_pinjam" => $request->durasi_pinjam
        ];

        // Simpan kembali ke session
        session()->put('cart', $cart);

        return redirect()->route('keranjang.show')->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    // Fungsi untuk menampilkan halaman keranjang
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $bookIds = array_keys($cart);
        $cartBooks = Book::whereIn('id', $bookIds)->get();

        return view('keranjang', compact('cartBooks', 'cart'));
    }

    public function removeFromCart(Book $book)
    {
        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Cek apakah buku ada di keranjang, lalu hapus
        if (isset($cart[$book->id])) {
            unset($cart[$book->id]);
        }

        // Simpan kembali array keranjang yang sudah diperbarui ke session
        session()->put('cart', $cart);

        // Redirect kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('keranjang.show')->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    // Fungsi untuk mengajukan peminjaman dari keranjang
    public function submitRequest(Request $request)
    {
        $cart = session()->get('cart', []);
        $userId = Auth::id();

        foreach ($cart as $bookId => $details) {
            Peminjaman::create([
                'user_id' => $userId,
                'book_id' => $bookId,
                'tanggal_pengajuan' => now(),
                'durasi_pinjam' => $details['durasi_pinjam'],
                'status' => 'Menunggu Verifikasi',
            ]);
        }

        // Kosongkan keranjang setelah pengajuan berhasil
        session()->forget('cart');

        return redirect()->route('peminjaman.sukses');
    }
}