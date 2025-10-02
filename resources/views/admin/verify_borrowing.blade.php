@extends('admin.layout.admin_layout')
@section('title', 'Verifikasi Peminjaman')

@section('content')
    <h2 class="fw-bold mb-4">Verifikasi Peminjaman</h2>

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

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tgl. Pengajuan</th>
                            <th class="text-center">Durasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($borrowRequests as $request)
                            <tr>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->book->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->tanggal_pengajuan)->format('d M Y') }}</td>
                                <td class="text-center">{{ $request->durasi_pinjam }} Hari</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#verificationModal{{ $request->id }}">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">Tidak ada permintaan peminjaman baru yang perlu
                                    diverifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Loop untuk membuat Modal Detail untuk setiap permintaan -->
    @foreach ($borrowRequests as $request)
        <div class="modal fade" id="verificationModal{{ $request->id }}" tabindex="-1"
            aria-labelledby="verificationModalLabel{{ $request->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verificationModalLabel{{ $request->id }}">Detail Verifikasi Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Kolom Kiri: Detail Buku -->
                            <div class="col-md-4 text-center">
                                <img src="{{ $request->book->sampul ? asset('covers/' . $request->book->sampul) : 'https://via.placeholder.com/200x300.png/ccc/FFFFFF?text=N/A' }}"
                                    class="img-fluid rounded mb-3" alt="Cover Buku">
                                <h6 class="fw-bold">{{ $request->book->judul }}</h6>
                                <p class="text-muted small">{{ $request->book->penulis }}</p>
                            </div>

                            <!-- Kolom Kanan: Detail Peminjaman -->
                            <div class="col-md-8">
                                <h5 class="mb-3">Informasi Peminjaman</h5>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td style="width: 150px;"><strong>Nama Peminjam</strong></td>
                                        <td>: {{ $request->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td>: {{ $request->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Pengajuan</strong></td>
                                        <td>: {{ \Carbon\Carbon::parse($request->tanggal_pengajuan)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Durasi Pinjam</strong></td>
                                        <td>: {{ $request->durasi_pinjam }} Hari</td>
                                    </tr>
                                    <tr class="fw-bold text-success">
                                        <td><strong>Estimasi Kembali</strong></td>
                                        <td>:
                                            {{ \Carbon\Carbon::parse($request->tanggal_pengajuan)->addDays($request->durasi_pinjam)->format('d M Y') }}
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    <div>
                                        Sisa stok buku saat ini: <strong>{{ $request->book->stok }}</strong>. Pastikan stok
                                        tersedia sebelum verifikasi.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        {{-- Form untuk Tombol Tolak bisa ditambahkan di sini nanti --}}
                        <form action="{{ route('admin.borrowing.verify', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Konfirmasi
                                Verifikasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection