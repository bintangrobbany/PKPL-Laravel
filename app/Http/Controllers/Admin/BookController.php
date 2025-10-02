<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book; // Import Model Book
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // <-- Import File facade

class BookController extends Controller
{
    /**
     * Menampilkan halaman manajemen buku dengan semua data buku.
     */
    public function index()
    {
        $books = Book::latest()->get(); // Ambil semua buku, urutkan dari yang terbaru
        return view('admin.manage_books', compact('books'));
    }

    /**
     * Menyimpan buku baru ke database.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer|min:0',
            'isbn' => 'nullable|string|unique:books,isbn,' . $book->id,
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $namaSampul = $book->sampul;

        if ($request->hasFile('sampul')) {
            // Hapus file sampul lama
            if ($book->sampul) {
                File::delete(public_path('covers/' . $book->sampul));
            }
            // Upload file baru
            $file = $request->file('sampul');
            $namaSampul = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('covers'), $namaSampul);
            
        }

        $book->update(array_merge($request->except('sampul'), ['sampul' => $namaSampul]));

        return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database.
     */
    public function destroy(Book $book)
    {
        if ($book->sampul) {
            File::delete(public_path('covers/' . $book->sampul));
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}