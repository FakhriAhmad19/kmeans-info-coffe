<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Coffee | K-Means Customer Segmentation</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Coffee Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/coffee-theme.css') }}">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="bi bi-cup-hot-fill text-warning"></i>
            <span>INFO COFFEE</span>
        </div>
        <div class="nav flex-column mt-3">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('produk.index') }}" class="nav-link {{ Route::is('produk.index') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Data Produk
            </a>
            <a href="{{ route('transaksi.index') }}" class="nav-link {{ Route::is('transaksi.index') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Data Transaksi
            </a>
            <a href="{{ route('clustering.index') }}" class="nav-link {{ Route::is('clustering.index') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i> Proses Clustering
            </a>
            <a href="{{ route('clustering.results') }}" class="nav-link {{ Route::is('clustering.results') ? 'active' : '' }}">
                <i class="bi bi-diagram-3"></i> Hasil Segmentasi
            </a>
            <a href="{{ route('laporan.index') }}" class="nav-link {{ Route::is('laporan.index') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan Segmentasi
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-auto p-3 pb-4">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 align-items-center d-flex justify-content-center gap-2">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar mb-4 rounded-3 shadow-sm">
            <button class="btn btn-link text-dark d-lg-none me-3 p-0" id="sidebarToggle" style="box-shadow: none;">
                <i class="bi bi-list fs-3"></i>
            </button>
            <div class="dropdown ms-auto">
                <button class="btn btn-link text-decoration-none dropdown-toggle text-dark fw-bold d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-5 text-secondary"></i>
                    <span>{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li><h6 class="dropdown-header">Admin Area</h6></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background-color: #E8F5E9; color: #1B5E20;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="background-color: #FFEBEE; color: #C62828;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dynamic Page Content -->
        @yield('content')

        <!-- Global Footer -->
        <footer class="text-center py-4 mt-5 border-top no-print" style="border-color: #E0D4C3 !important; color: var(--coffee-caramel); font-size: 0.85rem;">
            Info Coffee &copy; 2026. K-Means Clustering.
        </footer>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Responsive Toggle Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            
            if (toggleBtn && sidebar) {
                // Create overlay dynamically if it doesn't exist
                let overlay = document.querySelector('.sidebar-overlay');
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'sidebar-overlay';
                    document.body.appendChild(overlay);
                }

                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });

                overlay.addEventListener('click', function () {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>
