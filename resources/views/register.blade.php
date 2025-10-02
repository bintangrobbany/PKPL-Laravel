@extends('layout.layout')

@section('content')

    <div class="container" style="margin-top: 80px; margin-bottom: 80px;">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4 p-lg-5">

                        <div class="text-center mb-4">
                            <i class="bi bi-person-plus-fill text-primary" style="font-size: 3rem;"></i>
                            <h3 class="fw-bold mt-2">Buat Akun Baru</h3>
                            <p class="text-muted">Isi data di bawah ini untuk mendaftar.</p>
                        </div>

                        {{-- FORM REGISTER --}}
                        <form method="POST" action="/register">
                            @csrf {{-- Penting untuk keamanan Laravel --}}

                            {{-- Input Nama Lengkap --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" placeholder="Nama Lengkap Anda" required>
                                <label for="name">Nama Lengkap</label>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Input Email --}}
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                                <label for="email">Alamat Email</label>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Input Konfirmasi Password --}}
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Konfirmasi Password" required>
                                <label for="password_confirmation">Konfirmasi Password</label>
                            </div>

                            {{-- Tombol Register --}}
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg fw-bold" type="submit">Daftar</button>
                            </div>

                            {{-- Link ke Halaman Login --}}
                            <div class="text-center mt-4">
                                <p class="mb-0">Sudah punya akun? <a href="/login" class="fw-bold">Login di sini</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection