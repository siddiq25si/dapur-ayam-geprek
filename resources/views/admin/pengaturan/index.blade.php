@extends('layouts.admin.app')

@section('title', 'Pengaturan Toko')
@section('page-title', 'Pengaturan Profil & Operasional Toko')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-shop me-2 text-danger"></i>Informasi Operasional Katering</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jam Operasional Buka</label>
                        <input type="text" name="jam_buka" class="form-control @error('jam_buka') is-invalid @enderror"
                               value="{{ old('jam_buka', $pengaturan->jam_buka) }}" placeholder="Contoh: 08:00 - 21:00 WIB" required>
                        @error('jam_buka')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor WhatsApp Admin (Format Internasional 62...)</label>
                        <input type="text" name="no_whatsapp" class="form-control @error('no_whatsapp') is-invalid @enderror"
                               value="{{ old('no_whatsapp', $pengaturan->no_whatsapp) }}" placeholder="Contoh: 6281234567890" required>
                        <div class="form-text">Digunakan untuk tombol konsultasi katering WhatsApp di halaman pelanggan.</div>
                        @error('no_whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status Sertifikasi Halal</label>
                        <select name="status_halal" class="form-select @error('status_halal') is-invalid @enderror">
                            <option value="Tersertifikasi Halal" {{ old('status_halal', $pengaturan->status_halal) === 'Tersertifikasi Halal' ? 'selected' : '' }}>
                                Tersertifikasi Halal
                            </option>
                            <option value="100% Bahan Halal" {{ old('status_halal', $pengaturan->status_halal) === '100% Bahan Halal' ? 'selected' : '' }}>
                                100% Bahan Halal
                            </option>
                            <option value="Dalam Proses Sertifikasi" {{ old('status_halal', $pengaturan->status_halal) === 'Dalam Proses Sertifikasi' ? 'selected' : '' }}>
                                Dalam Proses Sertifikasi
                            </option>
                        </select>
                        @error('status_halal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-save me-1"></i> Simpan Pengaturan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection