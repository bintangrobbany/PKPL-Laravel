@extends('admin.layout.admin_layout')
@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <span class="text-muted">{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
    </div>

    <!-- KARTU STATISTIK -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-book-fill fs-2 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Buku</p>
                        <h4 class="fw-bold mb-0">{{ $bookCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-hourglass-split fs-2 text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Peminjaman Baru</p>
                        <h4 class="fw-bold mb-0">{{ $pendingCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-person-fill fs-2 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Anggota</p>
                        <h4 class="fw-bold mb-0">{{ $userCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VERIFIKASI TERTUNDA -->
    <div class="card mt-5">
        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Verifikasi Peminjaman Tertunda</h5>
            @if($pendingCount > 0)
                <a href="{{ route('admin.borrowing.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua <i class="bi bi-arrow-right-short"></i>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tgl. Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingRequests as $request)
                            <tr>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->book->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->tanggal_pengajuan)->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-4">
                                    <p class="mb-0 text-muted">Tidak ada permintaan peminjaman baru saat ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection