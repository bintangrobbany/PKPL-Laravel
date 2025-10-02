<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman detail buku untuk pengguna.
     */
    public function showBookDetail(Book $book)
    {
        // Laravel akan otomatis mencari buku berdasarkan ID dari URL
        // Ini disebut "Route Model Binding"
        return view('detailbuku', compact('book'));
    }
}