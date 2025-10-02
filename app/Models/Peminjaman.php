<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman'; // Eksplisit mendefinisikan nama tabel

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pengajuan',
        'durasi_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // Relasi ke model User: Satu peminjaman dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Book: Satu peminjaman untuk satu buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}