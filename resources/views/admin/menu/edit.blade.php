@extends('layouts.admin.app')

@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu Katering')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Menu
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Edit Menu: {{ $menu->nama_menu }}</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.menu.update', $menu->id_menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Menu <span class="text-danger">*</span></label>
                    <input type="text" name="nama_menu"
                           class="form-control @error('nama_menu') is-invalid @enderror"
                           value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                    @error('nama_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kategori Menu <span class="text-danger">*</span></label>
                    <select name="kategori_menu" class="form-select @error('kategori_menu') is-invalid @enderror" required>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ old('kategori_menu', $menu->kategori_menu) == $kat ? 'selected' : '' }}>
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
                           value="{{ old('harga', $menu->harga) }}" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok Porsi <span class="text-danger">*</span></label>
                    <input type="number" name="stok_porsi" min="0"
                           class="form-control @error('stok_porsi') is-invalid @enderror"
                           value="{{ old('stok_porsi', $menu->stok_porsi) }}" required>
                    @error('stok_porsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status Ketersediaan <span class="text-danger">*</span></label>
                    <select name="status_menu" class="form-select @error('status_menu') is-invalid @enderror" required>
                        <option value="Tersedia" {{ old('status_menu', $menu->status_menu) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Habis" {{ old('status_menu', $menu->status_menu) == 'Habis' ? 'selected' : '' }}>Habis</option>
                    </select>
                    @error('status_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi Menu</label>
                    <textarea name="deskripsi" rows="3"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ganti Foto Makanan (Opsional)</label>
                    <input type="file" name="foto" accept="image/*"
                           class="form-control @error('foto') is-invalid @enderror">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto saat ini.</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($menu->foto)
                        <div class="mt-2">
                            <span class="d-block small text-muted mb-1">Foto Saat Ini:</span>
                            <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}"
                                 class="rounded border object-fit-cover" style="width: 110px; height: 110px;">
                        </div>
                    @endif
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-light border px-4">Batal</a>
                <button type="submit" class="btn btn-warning px-4 fw-semibold">
                    <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsectionS