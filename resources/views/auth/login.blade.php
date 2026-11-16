<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Dapur Ayam Geprek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        .brand-panel {
            background: linear-gradient(135deg, #b91c1c 0%, #dc2626 60%, #ea580c 100%);
            color: #fff;
        }
        .btn-geprek {
            background-color: #dc2626;
            border-color: #dc2626;
            color: #fff;
            font-weight: 600;
        }
        .btn-geprek:hover {
            background-color: #b91c1c;
            border-color: #b91c1c;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card auth-card">
                <div class="row g-0">
                    <!-- Panel Kiri: Identitas Dapur Ayam Geprek -->
                    <div class="col-md-5 brand-panel p-4 p-lg-5 d-flex flex-column justify-content-between">
                        <div>
                            <a href="{{ route('home') }}" class="text-white text-decoration-none d-inline-flex align-items-center mb-4">
                                <i class="bi bi-arrow-left me-2"></i> Beranda
                            </a>
                            <div class="display-4 mb-3">🍗</div>
                            <h3 class="fw-bold mb-2">Dapur Ayam Geprek</h3>
                            <p class="opacity-75 mb-0">Pesan makanan favorit dengan mudah dan cepat.</p>
                        </div>
                        <div class="mt-4 small opacity-75">
                            Dapur Ayam Geprek &copy; 2026
                        </div>
                    </div>

                    <!-- Panel Kanan: Form Login -->
                    <div class="col-md-7 bg-white p-4 p-lg-5">
                        <h4 class="fw-bold mb-1">Selamat Datang</h4>
                        <p class="text-muted mb-4">Silakan masuk menggunakan akun Anda.</p>

                        <!-- Notifikasi Flash Message -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="contoh@email.com" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-geprek w-100 py-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                            </button>
                        </form>

                        <div class="text-center mt-4 small">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-danger fw-semibold text-decoration-none">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
