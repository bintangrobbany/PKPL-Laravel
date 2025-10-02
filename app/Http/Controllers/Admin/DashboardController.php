<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Book; // <-- TAMBAHKAN INI
use App\Models\User; // <-- TAMBAHKAN INI
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data ringkasan.
     */
    public function index()
    {
        // Menghitung jumlah total buku yang ada
        $bookCount = Book::count();

        // Menghitung jumlah total user (yang bukan admin)
        $userCount = User::where('role', 'user')->count();

        // Menghitung jumlah permintaan peminjaman yang statusnya 'Menunggu Verifikasi'
        $pendingCount = Peminjaman::where('status', 'Menunggu Verifikasi')->count();

        // Mengambil 5 permintaan terbaru yang masih tertunda untuk ditampilkan sebagai preview
        $pendingRequests = Peminjaman::with('user', 'book')
            ->where('status', 'Menunggu Verifikasi')
            ->latest()
            ->take(5) // Ambil 5 data terbaru saja
            ->get();

        // Kirim semua variabel data ke view
        return view('admin.dashboard', compact(
            'bookCount',
            'userCount',
            'pendingCount',
            'pendingRequests'
        ));
    }
}