@extends('layout.layout')
@section('title', 'Keranjang Peminjaman')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h1 class="display-6 fw-bold">Keranjang Peminjaman</h1>
            <p class="text-muted">Berikut adalah daftar buku yang siap Anda ajukan untuk dipinjam.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (!empty($cartBooks) && count($cartBooks) > 0)
        <div class="row">
            <!-- Kolom Kiri: Daftar Item Buku -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        @foreach ($cartBooks as $book)
                            <div class="row align-items-center {{ !$loop->last ? 'mb-4' : '' }}">
                                <div class="col-md-2 col-3">
                                    <img src="{{ $book->sampul ? asset('covers/' . $book->sampul) : 'https://via.placeholder.com/100x150.png/ccc/FFFFFF?text=N/A' }}" class="img-fluid rounded" alt="Cover Buku">
                                </div>
                                <div class="col-md-5 col-9">
                                    <h6 class="mb-1">{{ $book->judul }}</h6>
                                    <p class="small text-muted mb-0">{{ $book->penulis }}</p>
                                </div>
                                <div class="col-md-3 col-6 mt-2 mt-md-0 text-md-center">
                                    <span class="badge bg-light text-dark">Pinjam: {{ $cart[$book->id]['durasi_pinjam'] }} Hari</span>
                                </div>
                                <div class="col-md-2 col-6 mt-2 mt-md-0 text-end">
                                    <form action="{{ route('keranjang.hapus', $book->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus dari keranjang">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @if (!$loop->last) <hr> @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Ringkasan</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-muted">Total Jumlah Buku</p>
                            <p class="fw-bold">{{ count($cartBooks) }} Buku</p>
                        </div>
                        <hr>
                        <form action="{{ route('keranjang.submit') }}" method="POST" class="d-grid mt-3">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                Ajukan Peminjaman
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center p-5 bg-light rounded-3">
            <i class="bi bi-cart-x" style="font-size: 4rem;"></i>
            <h3 class="mt-3">Keranjang Anda Masih Kosong</h3>
            <p class="text-muted">Ayo cari buku menarik untuk dipinjam!</p>
            <a href="{{ route('buku.index') }}" class="btn btn-primary mt-2">Cari Buku Sekarang</a>
        </div>
    @endif
</div>
@endsection