@extends('layout.layout')

@section('content')

    <div class="container my-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Daftar Buku Kami</h1>
            <p class="lead text-muted">Temukan petualanganmu berikutnya dari koleksi terbaik kami.</p>

            {{-- Fitur Pencarian Sederhana --}}
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari judul atau penulis..."
                            aria-label="Cari buku">
                        <button class="btn btn-primary" type="button">Cari</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($books as $book)
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

                            <div class="mt-auto">
                                <div class="d-grid">
                                    <a href="{{ route('buku.detail', $book->id) }}" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center p-5">
                    <p class="h4">Belum ada buku yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $books->links() }}
        </div>
@endsection