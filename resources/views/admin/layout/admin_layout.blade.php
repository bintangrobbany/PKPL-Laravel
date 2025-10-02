<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - PerpusOnline</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            background-color: #212529;
            width: 250px;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, .8);
            padding: 12px 20px;
            font-weight: 500;
            transition: background-color 0.2s, color 0.2s;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #343a40;
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }

        .main-content {
            padding-left: 250px;
        }

        .top-navbar {
            height: 60px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .05);
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .05);
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- SIDEBAR -->
        <nav class="sidebar d-flex flex-column p-3">
            <h4 class="text-white text-center mt-3 mb-4">PerpusOnline</h4>
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="/admin"> <i
                            class="bi bi-speedometer2 me-2"></i> Dashboard </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/books*') ? 'active' : '' }}" href="/admin/books"> <i
                            class="bi bi-book me-2"></i> Manajemen Buku </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/borrowing*') ? 'active' : '' }}" href="/admin/borrowing">
                        <i class="bi bi-check2-square me-2"></i> Verifikasi Peminjaman </a>
                </li>
            </ul>
            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-grid">
                    @csrf
                    <button type="submit" class="nav-link text-start" style="background: none; border: none;">
                        <i class="bi bi-box-arrow-left me-2"></i> Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- KONTEN UTAMA -->
        <div class="main-content flex-grow-1">
            <!-- TOP NAVBAR -->
            <nav class="top-navbar d-flex justify-content-end align-items-center px-4">
                <div class="text-end">
                    <span class="fw-bold">Admin</span>
                    <br>
                    <small class="text-muted">admin@perpus.com</small>
                </div>
            </nav>

            <!-- ISI HALAMAN -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>