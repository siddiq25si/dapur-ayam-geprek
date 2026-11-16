@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Ringkasan Operasional Dapur')

@section('content')
<!-- Kartu Statistik -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-semibold">Total Katalog Menu</div>
                    <h3 class="fw-bold mb-0 mt-1">{{ $totalMenu }}</h3>
                </div>
                <div class="bg-danger-subtle text-danger rounded-3 p-3 fs-4">
                    <i class="bi bi-book"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-semibold">Total Pelanggan</div>
                    <h3 class="fw-bold mb-0 mt-1">{{ $totalPelanggan }}</h3>
                </div>
                <div class="bg-primary-subtle text-primary rounded-3 p-3 fs-4">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-semibold">Perlu Verifikasi Bayar</div>
                    <h3 class="fw-bold mb-0 mt-1 text-warning">{{ $menungguVerifikasi }}</h3>
                </div>
                <div class="bg-warning-subtle text-warning rounded-3 p-3 fs-4">
                    <i class="bi bi-receipt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-muted small fw-semibold">Pendapatan Selesai</div>
                    <h4 class="fw-bold mb-0 mt-1 text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                </div>
                <div class="bg-success-subtle text-success rounded-3 p-3 fs-4">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pesanan Terbaru -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-1 text-danger"></i> 5 Pesanan Masuk Terbaru</h6>
        <span class="badge bg-secondary">Total Pesanan: {{ $totalPesanan }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Jadwal Antar</th>
                        <th>Total Harga</th>
                        <th>Status Dapur</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesananTerbaru as $pesanan)
                        <tr>
                            <td class="ps-4 fw-semibold">#ORD-{{ $pesanan->id_pesanan }}</td>
                            <td>{{ $pesanan->pelanggan->user->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pengantaran)->format('d M Y H:i') }}</td>
                            <td class="fw-semibold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td><span class="badge bg-info text-dark">{{ $pesanan->status_pesanan }}</span></td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ $pesanan->pembayaran->status_verifikasi ?? 'Belum Bayar' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Belum ada transaksi pesanan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection