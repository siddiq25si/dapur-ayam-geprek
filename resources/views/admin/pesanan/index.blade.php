@extends('layouts.admin.app')

@section('title', 'Kelola Pesanan')
@section('page-title', 'Kelola Pesanan Masuk')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pesanan.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold text-muted">Cari ID Pesanan / Nama Pelanggan</label>
                <input type="text" name="search" class="form-control" placeholder="Contoh: Budi atau 1" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold text-muted">Filter Status Pesanan</label>
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    @foreach ($statusList as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-search me-1"></i> Filter
                </button>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                        <th class="ps-4">ID</th>
                        <th>Pelanggan</th>
                        <th>Jadwal Antar</th>
                        <th>Total Harga</th>
                        <th>Pembayaran</th>
                        <th>Status Pesanan</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanans as $item)
                        <tr>
                            <td class="ps-4 fw-bold">#{{ $item->id_pesanan }}</td>
                            <td>
                                <div class="fw-semibold">{{ $item->pelanggan->user->nama ?? '-' }}</div>
                                <small class="text-muted">{{ $item->pelanggan->no_hp ?? '' }}</small>
                            </td>
                            <td>
                                <div>{{ \Carbon\Carbon::parse($item->tanggal_pengantaran)->format('d M Y, H:i') }}</div>
                                <small class="text-muted">Pesan: {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d/m/Y') }}</small>
                            </td>
                            <td class="fw-semibold text-danger">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->pembayaran)
                                    <x-status-badge :status="$item->pembayaran->status_verifikasi" />
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary">Belum Bayar</span>
                                @endif
                            </td>
                            <td>
                                <x-status-badge :status="$item->status_pesanan" />
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.pesanan.show', $item->id_pesanan) }}" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-eye me-1"></i> Detail & Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada pesanan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($pesanans->hasPages())
        <div class="card-footer bg-white">
            {{ $pesanans->links() }}
        </div>
    @endif
</div>
@endsectionS