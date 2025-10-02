<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan Online</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Google Fonts (Opsional, untuk tampilan lebih modern) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        /* Menggunakan font Poppins untuk seluruh halaman */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Style untuk hero section di halaman beranda */
        .hero-section {
            background: linear-gradient(90deg, rgba(23, 107, 220, 1) 0%, rgba(11, 165, 226, 1) 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 30px 30px;
        }

        .navbar-brand {
            font-weight: 700;
            /* Membuat brand lebih tebal */
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    {{-- HEADER --}}
    {{-- Mengubah bg-dark menjadi bg-primary dan menambahkan shadow --}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">PerpusOnline</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/buku">Daftar Buku</a>
                        </li>
                        {{-- KONDISI JIKA PENGGUNA BELUM LOGIN (GUEST) --}}
                        @guest
                            <li class="nav-item ms-lg-3">
                                <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item ms-lg-2">
                                <a class="btn btn-light text-primary" href="{{ route('register') }}">Register</a>
                            </li>
                        @endguest

                        {{-- KONDISI JIKA PENGGUNA SUDAH LOGIN (AUTHENTICATED) --}}
                        @auth
                            <li class="nav-item ms-lg-3">
                                <a class="nav-link fs-5" href="/keranjang">
                                    <i class="bi bi-cart"></i>
                                    <span class="badge bg-danger rounded-pill translate-middle"
                                        style="font-size: 0.6em;">3</span>
                                </a>
                            </li>

                            {{-- DROPDOWN PROFIL PENGGUNA --}}
                            <li class="nav-item dropdown ms-lg-3">
                                {{-- Tombol Pemicu Dropdown (Logo Profil) --}}
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-person-circle fs-4"></i>
                                </a>

                                {{-- Isi Dropdown --}}
                                <ul class="dropdown-menu dropdown-menu-end">
                                    {{-- Header Dropdown dengan Nama & Email User --}}
                                    <li>
                                        <div class="px-3 py-2">
                                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                                            <div class="small text-muted">{{ auth()->user()->email }}</div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    {{-- Jika user adalah admin, tampilkan link ke Dashboard --}}
                                    @if (auth()->user()->role == 'admin')
                                        <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2 me-2"></i>Admin
                                                Dashboard</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    @endif

                                    {{-- Tombol Logout --}}
                                    <li>
                                        {{-- Logout harus menggunakan form dengan method POST untuk keamanan --}}
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-left me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- KONTEN UTAMA --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    {{-- Mengubah footer menjadi lebih cerah dan bersih --}}
    <footer class="text-center p-4 mt-auto bg-white">
        <p class="mb-0 text-muted">&copy; 2025 PerpusOnline. Dibuat dengan ❤️</p>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    {{-- Inisialisasi AOS --}}
    <script>
        AOS.init();
    </script>
</body>

</html>