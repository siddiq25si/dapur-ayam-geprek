<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    public function index(Request $request)
    {
        $pesanans = Pesanan::with(['pelanggan.user', 'pembayaran'])
            ->when($request->status, function ($query, $status) {
                $query->where('status_pesanan', $status);
            })
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('id_pesanan', 'like', '%' . $search . '%')
                      ->orWhereHas('pelanggan.user', function ($u) use ($search) {
                          $u->where('nama', 'like', '%' . $search . '%');
                      });
                });
            })
            ->latest('tanggal_pesan')
            ->paginate(10)
            ->withQueryString();

        $statusList = [
            'Menunggu Konfirmasi',
            'Sedang Dimasak',
            'Dalam Pengiriman',
            'Selesai',
            'Dibatalkan',
        ];

        return view('admin.pesanan.index', compact('pesanans', 'statusList'));
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['pelanggan.user', 'detailPesanan.menu', 'pembayaran']);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'status_pesanan' => 'required|in:Menunggu Konfirmasi,Sedang Dimasak,Dalam Pengiriman,Selesai,Dibatalkan',
        ]);

        // Kembalikan stok porsi jika pesanan dibatalkan
        if ($validated['status_pesanan'] === 'Dibatalkan' && $pesanan->status_pesanan !== 'Dibatalkan') {
            foreach ($pesanan->detailPesanan as $detail) {
                if ($detail->menu) {
                    $detail->menu->increment('stok_porsi', $detail->jumlah);
                }
            }
        }

        $pesanan->update(['status_pesanan' => $validated['status_pesanan']]);

        return redirect()->route('admin.pesanan.show', $pesanan->id_pesanan)
            ->with('success', 'Status pesanan #' . $pesanan->id_pesanan . ' berhasil diperbarui menjadi "' . $validated['status_pesanan'] . '".');
    }

    public function verifikasiPembayaran(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'status_verifikasi' => 'required|in:Terverifikasi,Ditolak',
        ]);

        $pembayaran->update(['status_verifikasi' => $validated['status_verifikasi']]);

        // Otomatis ubah status pesanan ke "Sedang Dimasak" jika pembayaran terverifikasi
        if ($validated['status_verifikasi'] === 'Terverifikasi' && $pembayaran->pesanan->status_pesanan === 'Menunggu Konfirmasi') {
            $pembayaran->pesanan->update(['status_pesanan' => 'Sedang Dimasak']);
        }

        return redirect()->route('admin.pesanan.show', $pembayaran->id_pesanan)
            ->with('success', 'Status pembayaran berhasil diubah menjadi "' . $validated['status_verifikasi'] . '".');
    }
}