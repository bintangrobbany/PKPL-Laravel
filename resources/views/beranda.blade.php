@extends('layout.layout')

@section('content')

    {{-- Hero Section --}}
    <div class="hero-section">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold">Jelajahi Dunia, Satu Buku Sekaligus.</h1>
                    <p class="fs-5 mt-3 mb-4">Pinjam buku favoritmu secara online dengan mudah, cepat, dan dari mana saja.
                    </p>
                    <a href="#" class="btn btn-light btn-lg fw-bold">Mulai Membaca</a>
                </div>
                <div class="col-md-6 text-center">
                    {{-- Anda bisa menggunakan ilustrasi dari unDraw atau gambar lain --}}
                    <img src="{{ asset('images/Hero.jpg') }}" class="img-fluid" alt="Ilustrasi Perpustakaan Online">
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Buku Populer --}}
    {{-- Bagian Buku Populer dengan Animasi --}}
    <div class="container my-5">
        <h2 class="text-center fw-bold mb-4">Buku Populer Saat Ini</h2>
        <div class="row">
            @forelse ($popularBooks as $book)
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($book->sampul)
                            <img src="{{ asset('covers/' . $book->sampul) }}" class="card-img-top" alt="{{ $book->judul }}"
                                style="height: 320px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x450.png/ccc/FFFFFF?text=No+Cover" class="card-img-top"
                                alt="No Cover" style="height: 320px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($book->judul, 40) }}</h5>
                            <p class="card-text text-muted small mb-3">{{ $book->penulis }}</p>
                            <div class="mt-auto d-grid">
                                <a href="{{ route('buku.detail', $book->id) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada buku populer yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection