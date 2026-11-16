@extends('layouts.admin.app')

@section('title', 'Tambah Menu Baru')
@section('page-title', 'Tambah Menu Katering')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Menu
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Form Tambah Menu Baru</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Menu <span class="text-danger">*</span></label>
                    <input type="text" name="nama_menu"
                           class="form-control @error('nama_menu') is-invalid @enderror"
                           placeholder="Contoh: Paket Kotak Ayam Geprek Sambal Ijo"
                           value="{{ old('nama_menu') }}" required>
                    @error('nama_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kategori Menu <span class="text-danger">*</span></label>
                    <select name="kategori_menu" class="form-select @error('kategori_menu') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ old('kategori_menu') == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga" min="0"
                           class="form-control @error('harga') is-invalid @enderror"
                           placeholder="18000"
                           value="{{ old('harga') }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok Porsi <span class="text-danger">*</span></label>
                    <input type="number" name="stok_porsi" min="0"
                           class="form-control @error('stok_porsi') is-invalid @enderror"
                           placeholder="50"
                           value="{{ old('stok_porsi', 50) }}" required>
                    @error('stok_porsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status Ketersediaan <span class="text-danger">*</span></label>
                    <select name="status_menu" class="form-select @error('status_menu') is-invalid @enderror" required>
                        <option value="Tersedia" {{ old('status_menu') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Habis" {{ old('status_menu') == 'Habis' ? 'selected' : '' }}>Habis</option>
                    </select>
                    @error('status_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi Menu</label>
                    <textarea name="deskripsi" rows="3"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Jelaskan isi paket, tingkat kepedasan, atau kelengkapan lauk...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Foto Makanan (JPG, PNG, WEBP &bull; Maks 2MB)</label>
                    <input type="file" name="foto" accept="image/*"
                           class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-light border px-4">Batal</a>
                <button type="submit" class="btn btn-danger px-4">
                    <i class="bi bi-save me-1"></i> Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection