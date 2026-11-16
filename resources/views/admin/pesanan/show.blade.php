@extends('layouts.admin.app')

@section('title', 'Detail Pesanan #' . $pesanan->id_pesanan)
@section('page-title', 'Detail Pesanan #' . $pesanan->id_pesanan)

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pesanan
    </a>
</div>

<div class="row g-4">
    {{-- Kolom Kiri: Info Pesanan & Rincian Item --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Informasi Pengantaran</h6>
                <x-status-badge :status="$pesanan->status_pesanan" />
            </div>
            <div class="card-body">
                <div class="row g-3 small">
                    <div class="col-sm-6">
                        <div class="text-muted">Nama Pelanggan</div>
                        <div class="fw-semibold fs-6">{{ $pesanan->pelanggan->user->nama ?? '-' }}</div>
                        <div class="text-muted">{{ $pesanan->pelanggan->no_hp ?? '-' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted">Jadwal Pengantaran</div>
                        <div class="fw-semibold fs-6">{{ \Carbon\Carbon::parse($pesanan->tanggal_pengantaran)->format('d M Y, H:i') }} WIB</div>
                        <div class="text-muted">Dipesan: {{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="col-12">
                        <div class="text-muted">Alamat Pengantaran</div>
                        <div class="fw-semibold">{{ $pesanan->alamat_pengantaran }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0">Rincian Menu Dipesan</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Menu</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan->detailPesanan as $detail)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $detail->menu->nama_menu ?? 'Menu Dihapus' }}</td>
                                    <td class="text-center">{{ $detail->jumlah }} porsi</td>
                                    <td class="text-end">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="text-end pe-4 fw-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total Pembayaran</th>
                                <th class="text-end pe-4 text-danger fs-6">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Update Status & Verifikasi Bukti Transfer --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0">Update Status Pesanan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pesanan.update-status', $pesanan->id_pesanan) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status Produksi / Pengiriman</label>
                        <select name="status_pesanan" class="form-select">
                            @foreach (['Menunggu Konfirmasi', 'Sedang Dimasak', 'Dalam Pengiriman', 'Selesai', 'Dibatalkan'] as $st)
                                <option value="{{ $st }}" {{ $pesanan->status_pesanan === $st ? 'selected' : '' }}>
                                    {{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Bukti Pembayaran</h6>
                @if ($pesanan->pembayaran)
                    <x-status-badge :status="$pesanan->pembayaran->status_verifikasi" />
                @endif
            </div>
            <div class="card-body">
                @if ($pesanan->pembayaran)
                    <div class="small mb-2">
                        <span class="text-muted">Nominal Transfer:</span>
                        <strong class="text-dark">Rp {{ number_format($pesanan->pembayaran->jumlah_bayar, 0, ',', '.') }}</strong>
                    </div>
                    <div class="small mb-3">
                        <span class="text-muted">Waktu Unggah:</span>
                        <span>{{ \Carbon\Carbon::parse($pesanan->pembayaran->tanggal_bayar)->format('d M Y, H:i') }}</span>
                    </div>

                    <a href="{{ asset('storage/' . $pesanan->pembayaran->bukti_transfer) }}" target="_blank" class="d-block mb-3">
                        <img src="{{ asset('storage/' . $pesanan->pembayaran->bukti_transfer) }}"
                             alt="Bukti Transfer" class="img-fluid rounded border w-100" style="max-height: 260px; object-fit: cover;">
                    </a>

                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.pembayaran.verifikasi', $pesanan->pembayaran->id_pembayaran) }}" method="POST" class="w-50">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status_verifikasi" value="Terverifikasi">
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                <i class="bi bi-check-lg me-1"></i> Terima
                            </button>
                        </form>
                        <form action="{{ route('admin.pembayaran.verifikasi', $pesanan->pembayaran->id_pembayaran) }}" method="POST" class="w-50">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status_verifikasi" value="Ditolak">
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bi bi-x-lg me-1"></i> Tolak
                            </button>
                        </form>
                    </div>
                @else
                    <div class="text-center text-muted py-4 small">
                        <i class="bi bi-receipt fs-3 d-block mb-1"></i>
                        Pelanggan belum mengunggah bukti transfer.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsectionS