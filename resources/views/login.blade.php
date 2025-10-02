@extends('layout.layout')

@section('content')

    <div class="container" style="margin-top: 80px; margin-bottom: 80px;">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4 p-lg-5">

                        <div class="text-center mb-4">
                            <i class="bi bi-box-arrow-in-right text-primary" style="font-size: 3rem;"></i>
                            <h3 class="fw-bold mt-2">Login Akun</h3>
                            <p class="text-muted">Selamat datang kembali! Silakan masuk.</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- FORM LOGIN --}}
                        <form method="POST" action="/login">
                            @csrf {{-- Penting untuk keamanan Laravel --}}

                            {{-- Input Email --}}
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                                <label for="email">Alamat Email</label>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>

                            {{-- Tombol Login --}}
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg fw-bold" type="submit">Login</button>
                            </div>

                            {{-- Link ke Halaman Register --}}
                            <div class="text-center mt-4">
                                <p class="mb-0">Belum punya akun? <a href="/register" class="fw-bold">Daftar di sini</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection