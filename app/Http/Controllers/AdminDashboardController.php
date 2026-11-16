<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Pesanan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalPelanggan = Pelanggan::count();
        $totalPesanan = Pesanan::count();
        $menungguVerifikasi = Pembayaran::where('status_verifikasi', 'Menunggu Verifikasi')->count();
        $totalPendapatan = Pesanan::where('status_pesanan', 'Selesai')->sum('total_harga');

        $pesananTerbaru = Pesanan::with(['pelanggan.user', 'pembayaran'])
            ->latest('tanggal_pesan')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMenu',
            'totalPelanggan',
            'totalPesanan',
            'menungguVerifikasi',
            'totalPendapatan',
            'pesananTerbaru'
        ));
    }
}