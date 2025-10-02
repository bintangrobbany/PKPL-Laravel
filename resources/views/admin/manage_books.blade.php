@extends('admin.layout.admin_layout')
@section('title', 'Manajemen Buku')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manajemen Buku</h2>
        <button class="btn btn-primary" id="add-book-btn" data-bs-toggle="modal" data-bs-target="#bookModal">
            <i class="bi bi-plus-circle me-2"></i>Tambah Buku Baru
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ $book->sampul ? asset('covers/' . $book->sampul) : 'https://via.placeholder.com/60x90.png/ccc/FFFFFF?text=N/A' }}"
                                        class="rounded" style="width: 50px;" alt="Cover">
                                </td>
                                <td>
                                    {{ $book->judul }}
                                    <br>
                                    <small class="text-muted">{{ $book->penulis }}</small>
                                </td>
                                <td>
                                    @if ($book->is_popular)
                                        <span class="badge bg-success"><i class="bi bi-star-fill"></i> Populer</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $book->stok }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#bookModal" data-book="{{ $book }}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="{{ $book->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4">Belum ada data buku. Silakan tambahkan buku baru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Buku -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="bookForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="method-field"></div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Kolom Kiri Form -->
                            <div class="col-md-6">
                                <div class="mb-3"><label for="judul" class="form-label">Judul Buku</label><input type="text"
                                        class="form-control" id="judul" name="judul" required></div>
                                <div class="mb-3"><label for="penulis" class="form-label">Nama Penulis</label><input
                                        type="text" class="form-control" id="penulis" name="penulis" required></div>
                                <div class="mb-3"><label for="penerbit" class="form-label">Penerbit</label><input
                                        type="text" class="form-control" id="penerbit" name="penerbit" required></div>
                            </div>
                            <!-- Kolom Kanan Form -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3"><label for="tahun_terbit" class="form-label">Tahun
                                                Terbit</label><input type="number" class="form-control" id="tahun_terbit"
                                                name="tahun_terbit" placeholder="Contoh: 2023" required></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3"><label for="stok" class="form-label">Stok</label><input
                                                type="number" class="form-control" id="stok" name="stok" required></div>
                                    </div>
                                </div>
                                <div class="mb-3"><label for="isbn" class="form-label">ISBN (Opsional)</label><input
                                        type="text" class="form-control" id="isbn" name="isbn"></div>
                                <div class="mb-3"><label for="sampul" class="form-label">Cover Buku</label><input
                                        class="form-control" type="file" id="sampul" name="sampul"><small
                                        class="form-text text-muted">Kosongkan jika tidak ingin mengubah sampul.</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_popular" name="is_popular"
                                value="1">
                            <label class="form-check-label" for="is_popular">Jadikan Buku Populer (Tampil di
                                Beranda)</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus buku ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookModal = document.getElementById('bookModal');
            const bookForm = document.getElementById('bookForm');
            const modalLabel = document.getElementById('bookModalLabel');
            const methodField = document.getElementById('method-field');

            bookModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const bookData = button.getAttribute('data-book');

                // Reset form setiap kali modal dibuka
                bookForm.reset();

                if (bookData) { // EDIT MODE
                    const book = JSON.parse(bookData);
                    modalLabel.textContent = 'Edit Buku';
                    bookForm.action = `/admin/books/${book.id}`;
                    methodField.innerHTML = `@method('PUT')`;

                    // Mengisi setiap field di form dengan data dari buku
                    bookForm.querySelector('#judul').value = book.judul;
                    bookForm.querySelector('#penulis').value = book.penulis;
                    bookForm.querySelector('#penerbit').value = book.penerbit;
                    bookForm.querySelector('#tahun_terbit').value = book.tahun_terbit;
                    bookForm.querySelector('#stok').value = book.stok;
                    bookForm.querySelector('#isbn').value = book.isbn;
                    bookForm.querySelector('#is_popular').checked = (book.is_popular == 1);

                } else { // ADD MODE (ketika tombol "Tambah Buku Baru" diklik)
                    modalLabel.textContent = 'Tambah Buku Baru';
                    bookForm.action = `{{ route('admin.books.store') }}`;
                    methodField.innerHTML = '';
                }
            });

            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const bookId = button.getAttribute('data-id');
                const deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `/admin/books/${bookId}`;
            });
        });
    </script>
@endpush