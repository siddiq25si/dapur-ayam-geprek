@props(['status'])

@php
    $badgeClass = match ($status) {
        'Menunggu Konfirmasi', 'Menunggu Verifikasi' => 'bg-warning-subtle text-warning-emphasis border-warning-subtle',
        'Sedang Dimasak' => 'bg-info-subtle text-info-emphasis border-info-subtle',
        'Dalam Pengiriman' => 'bg-primary-subtle text-primary-emphasis border-primary-subtle',
        'Selesai', 'Terverifikasi', 'Tersedia' => 'bg-success-subtle text-success border-success-subtle',
        'Dibatalkan', 'Ditolak', 'Habis' => 'bg-danger-subtle text-danger border-danger-subtle',
        default => 'bg-secondary-subtle text-secondary border-secondary-subtle',
    };
@endphp

<span {{ $attributes->merge(['class' => "badge border fw-semibold px-2 py-1 {$badgeClass}"]) }}>
    {{ $status }}
</span>