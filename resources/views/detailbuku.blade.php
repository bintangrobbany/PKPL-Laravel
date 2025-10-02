@extends('layout.layout')
@section('title', $book->judul)

@section('content')
    <div class="container my-5">
        <div class="row g-5">
            <!-- Kolom Kiri: Cover Buku -->
            <div class="col-md-4">
                @if ($book->sampul)
                    <img src="{{ asset('covers/' . $book->sampul) }}" class="img-fluid rounded shadow-sm w-100"
                        alt="{{ $book->judul }}">
                @else
                    <img src="https://via.placeholder.com/400x600.png/ccc/FFFFFF?text=No+Cover"
                        class="img-fluid rounded shadow-sm w-100" alt="No Cover">
                @endif
            </div>

            <!-- Kolom Kanan: Detail & Aksi -->
            <div class="col-md-8">
                <h1 class="display-6 fw-bold">{{ $book->judul }}</h1>
                <p class="text-muted fs-5">oleh {{ $book->penulis }}</p>
                <hr>

                <table class="table table-borderless">
                    <tr>
                        <td style="width: 150px;"><strong>Penerbit</strong></td>
                        <td>: {{ $book->penerbit }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tahun Terbit</strong></td>
                        <td>: {{ $book->tahun_terbit }}</td>
                    </tr>
                    <tr>
                        <td><strong>ISBN</strong></td>
                        <td>: {{ $book->isbn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Stok Tersedia</strong></td>
                        <td>: <span class="badge bg-success fs-6">{{ $book->stok }}</span></td>
                    </tr>
                </table>

                <div class="card bg-light border-0 mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Ajukan Peminjaman</h5>
                        <form action="{{ route('keranjang.tambah', $book->id) }}" method="POST">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-md-8">
                                    <label for="durasi_pinjam" class="form-label">Pilih Lama Peminjaman:</label>
                                    <select class="form-select" id="durasi_pinjam" name="durasi_pinjam" required>
                                        <option value="7">7 Hari</option>
                                        <option value="14" selected>14 Hari</option>
                                        <option value="21">21 Hari</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-grid">
                                    <button type="submit" class="btn btn-primary mt-3 mt-md-0" {{ $book->stok < 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus"></i>
                                        {{ $book->stok < 1 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary mt-4"><i class="bi bi-arrow-left"></i>
                    Kembali</a>
            </div>
        </div>
    </div>
@endsection