@extends('layouts.admin.app')

@section('title', 'Data Pelanggan')
@section('page-title', 'Data Pelanggan Terdaftar')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pelanggan.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari nama pelanggan, email, nomor WhatsApp, atau alamat..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>No. HP / WhatsApp</th>
                        <th>Alamat Utama</th>
                        <th class="text-center pe-4">Total Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $index => $pelanggan)
                        <tr>
                            <td class="ps-4">{{ $pelanggans->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $pelanggan->user->nama ?? '-' }}</td>
                            <td>{{ $pelanggan->user->email ?? '-' }}</td>
                            <td>{{ $pelanggan->no_hp }}</td>
                            <td style="max-width: 280px;">{{ $pelanggan->alamat }}</td>
                            <td class="text-center pe-4">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1">
                                    {{ $pelanggan->pesanan_count }} Pesanan
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($pelanggans->hasPages())
        <div class="card-footer bg-white">
            {{ $pelanggans->links() }}
        </div>
    @endif
</div>
@endsection