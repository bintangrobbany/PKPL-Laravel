<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    // Menampilkan halaman verifikasi dengan data peminjaman yang relevan
    public function index()
    {
        // Menggunakan eager loading (with) agar lebih efisien
        $borrowRequests = Peminjaman::with('user', 'book')
            ->where('status', 'Menunggu Verifikasi')
            ->latest()
            ->get();
            
        return view('admin.verify_borrowing', compact('borrowRequests'));
    }

    // Memproses verifikasi peminjaman
    public function verify(Peminjaman $peminjaman)
    {
        // Cek stok sebelum verifikasi
        if ($peminjaman->book->stok < 1) {
            return back()->with('error', 'Verifikasi gagal! Stok buku "' . $peminjaman->book->judul . '" sudah habis.');
        }

        // Gunakan transaction untuk memastikan kedua operasi (update & decrement) berhasil
        DB::transaction(function () use ($peminjaman) {
            // 1. Update status peminjaman
            $peminjaman->update([
                'status' => 'Diverifikasi',
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => now()->addDays($peminjaman->durasi_pinjam),
            ]);

            // 2. Kurangi stok buku
            $peminjaman->book->decrement('stok');
        });

        return redirect()->route('admin.borrowing.index')->with('success', 'Peminjaman berhasil diverifikasi!');
    }
}