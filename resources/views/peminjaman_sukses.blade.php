@extends('layout.layout')
@section('title', 'Pengajuan Berhasil')

@section('content')
<div class="container text-center" style="margin-top: 100px; margin-bottom: 100px;">
    <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
    <h1 class="mt-3">Pengajuan Peminjaman Berhasil!</h1>
    <p class="lead text-muted">Silakan menuju ke perpustakaan untuk mengambil buku Anda.</p>
    <a href="{{ route('buku.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Buku</a>
</div>
@endsection