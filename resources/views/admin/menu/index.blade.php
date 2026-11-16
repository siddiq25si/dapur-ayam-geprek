@extends('layouts.admin.app')

@section('title', 'Manajemen Menu')
@section('page-title', 'Manajemen Menu Katering')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Daftar Menu Katering</h4>
        <p class="text-muted small mb-0">Kelola katalog paket katering, harga, stok porsi harian, dan foto menu.</p>
    </div>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-danger px-4 shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Menu
    </a>
</div>

<!-- Form Search & Filter Kategori -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.menu.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama menu atau deskripsi..."
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="kategori" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-dark w-100">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                @if (request('search') || request('kategori'))
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Tabel Daftar Menu -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" width="5%">No</th>
                        <th width="10%">Foto</th>
                        <th width="27%">Nama Menu</th>
                        <th width="15%">Kategori</th>
                        <th width="13%">Harga</th>
                        <th width="10%">Stok</th>
                        <th width="10%">Status</th>
                        <th class="text-center pe-4" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $index => $item)
                        <tr>
                            <td class="ps-4">{{ $menus->firstItem() + $index }}</td>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                         alt="{{ $item->nama_menu }}"
                                         class="rounded border object-fit-cover"
                                         style="width: 60px; height: 60px;">
                                @else
                                    <div class="rounded border bg-light d-flex align-items-center justify-content-center text-muted"
                                         style="width: 60px; height: 60px;">
                                        <i class="bi bi-image fs-4"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $item->nama_menu }}</div>
                                <small class="text-muted d-block text-truncate" style="max-width: 260px;">
                                    {{ $item->deskripsi ?? '-' }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-dark border">
                                    {{ $item->kategori_menu }}
                                </span>
                            </td>
                            <td class="fw-semibold text-danger">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="fw-bold {{ $item->stok_porsi <= 10 ? 'text-danger' : 'text-dark' }}">
                                    {{ $item->stok_porsi }}
                                </span> porsi
                            </td>
                            <td>
                                @if ($item->status_menu === 'Tersedia')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                        Habis
                                    </span>
                                @endif
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.menu.edit', $item->id_menu) }}"
                                       class="btn btn-sm btn-warning text-dark" title="Edit Menu">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.menu.destroy', $item->id_menu) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus menu {{ $item->nama_menu }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Menu">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Data menu tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($menus->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $menus->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection