<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Dapur Ayam Geprek</title>
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
        <div class="col-lg-10">
            <div class="card auth-card">
                <div class="row g-0">
                    <!-- Panel Kiri -->
                    <div class="col-md-4 brand-panel p-4 p-lg-5 d-flex flex-column justify-content-between">
                        <div>
                            <a href="{{ route('home') }}" class="text-white text-decoration-none d-inline-flex align-items-center mb-4">
                                <i class="bi bi-arrow-left me-2"></i> Beranda
                            </a>
                            <div class="display-4 mb-3">🍱</div>
                            <h3 class="fw-bold mb-2">Gabung Sekarang</h3>
                            <p class="opacity-75 mb-0">Buat akun pelanggan untuk mulai memesan katering, mengatur jadwal antar, dan melacak status masakan.</p>
                        </div>
                        <div class="mt-4 small opacity-75">
                            Dapur Ayam Geprek &copy; 2026
                        </div>
                    </div>

                    <!-- Panel Kanan: Form Registrasi -->
                    <div class="col-md-8 bg-white p-4 p-lg-5">
                        <h4 class="fw-bold mb-1">Daftar Akun Pelanggan</h4>
                        <p class="text-muted mb-4">Lengkapi data diri dan alamat pengiriman Anda.</p>

                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Nama lengkap Anda" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label fw-semibold">No. HP / WhatsApp</label>
                                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        placeholder="0812xxxxxxxx" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="contoh@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-semibold">Alamat Utama Pengantaran</label>
                                <textarea id="alamat" name="alamat" rows="2"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    placeholder="Jl. Nama Jalan, No. Rumah, Kecamatan, Kota" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">Password (Min. 6 karakter)</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Buat password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="Ulangi password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-geprek w-100 py-2 mt-2">
                                <i class="bi bi-person-plus-fill me-1"></i> Daftar Sekarang
                            </button>
                        </form>

                        <div class="text-center mt-4 small">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-danger fw-semibold text-decoration-none">Masuk di sini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
