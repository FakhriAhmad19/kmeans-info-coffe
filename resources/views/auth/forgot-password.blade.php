<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Coffee | Reset Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        :root {
            --coffee-espresso: #2B1B17;
            --coffee-mocha: #4E342E;
            --coffee-caramel: #8D6E63;
            --coffee-latte: #D7CCC8;
            --coffee-cream: #FDFBF7;
            --coffee-text: #3E2723;
        }

        html, body {
            background-color: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            height: 100vh !important;
            width: 100vw !important;
            overflow: hidden !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-fullscreen-container {
            background: #ffffff !important;
            width: 100vw !important;
            height: 100vh !important;
            min-height: 100vh !important;
            display: flex !important;
            margin: 0 !important;
            padding: 0 !important;
            border-radius: 0 !important;
            border: none !important;
            box-shadow: none !important;
            overflow: hidden !important;
        }

        .login-fullscreen-container .row {
            height: 100% !important;
            min-height: 100vh !important;
            margin: 0 !important;
            width: 100% !important;
        }

        .image-section {
            background: url("{{ asset('images/v60.jpg') }}") no-repeat center center !important;
            background-size: cover !important;
            position: relative !important;
            height: 100vh !important;
            min-height: 100vh !important;
            padding: 0 !important;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(43, 27, 23, 0.85) 0%, rgba(78, 52, 46, 0.65) 100%) !important;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 60px;
            color: #fff;
        }

        .form-section {
            padding: 40px 80px !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
            height: 100vh !important;
            min-height: 100vh !important;
            background-color: #ffffff !important;
            overflow-y: auto !important;
        }

        @media (max-width: 768px) {
            .form-section {
                padding: 40px 30px !important;
            }
        }

        .brand-header {
            font-size: 2.2rem;
            font-weight: bold;
            color: var(--coffee-espresso);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn-coffee {
            background-color: var(--coffee-mocha);
            color: #fff;
            border: none;
            padding: 14px;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.2s;
        }

        .btn-coffee:hover {
            background-color: var(--coffee-espresso);
            color: #fff;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
            transition: border-color 0.2s, color 0.2s;
        }

        .form-control {
            padding: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: var(--coffee-caramel) !important;
            box-shadow: 0 0 0 0.25rem rgba(141, 110, 99, 0.25) !important;
            background-color: #ffffff !important;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--coffee-caramel) !important;
            color: var(--coffee-mocha) !important;
        }
    </style>
</head>
<body>

    <div class="login-fullscreen-container">
        <div class="row g-0 w-100">
            <!-- Left Side: Image -->
            <div class="col-md-6 d-none d-md-block image-section">
                <div class="image-overlay">
                    <div class="mb-4">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold text-uppercase fs-7">Info Coffee Shop</span>
                    </div>
                    <h1 class="fw-bold mb-3 display-5">Pemulihan Kata Sandi Akun</h1>
                    <p class="text-white-50 mb-0 fs-5">Verifikasi username dan email Anda untuk mengatur ulang kata sandi administrator Anda secara langsung.</p>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="col-md-6 form-section bg-white">
                <div style="max-width: 450px; margin: auto !important; width: 100%; padding: 30px 0;">
                    <div class="brand-header">
                        <i class="bi bi-cup-hot-fill text-warning"></i>
                        <span>INFO COFFEE</span>
                    </div>

                    <h3 class="mb-2 fw-bold text-dark"><i class="bi bi-key"></i> Lupa Password</h3>
                    <p class="text-muted mb-4 small">Isi rincian akun Anda untuk membuat password baru.</p>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-3" style="background-color: #FFEBEE; color: #C62828; font-size: 0.85rem;">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold text-secondary small mb-1">Username Akun</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0 bg-light" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username terdaftar" required autofocus>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-secondary small mb-1">Email Terdaftar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0 bg-light" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email terdaftar" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-secondary small mb-1">Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control border-start-0 ps-0 bg-light" id="password" name="password" placeholder="Min 6 karakter" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold text-secondary small mb-1">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control border-start-0 ps-0 bg-light" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-coffee rounded-3 py-3 fw-bold text-uppercase tracking-wide">RESET PASSWORD & MASUK</button>
                        
                        <div class="mt-3 text-center">
                            <span class="text-muted small">Kembali ke halaman</span>
                            <a href="{{ route('login') }}" class="small fw-bold text-decoration-none ms-1" style="color: var(--coffee-mocha);">Masuk</a>
                        </div>
                    </form>
                    
                    <div class="mt-4 pt-3 border-top text-center text-muted" style="font-size: 0.8rem;">
                        Info Coffee &copy; 2026. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
