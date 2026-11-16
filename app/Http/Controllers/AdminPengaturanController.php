<?php

namespace App\Http\Controllers;

use App\Models\PengaturanWeb;
use Illuminate\Http\Request;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanWeb::firstOrCreate(
            [],
            [
                'jam_buka'     => '08:00 - 21:00 WIB',
                'no_whatsapp'  => '6281234567890',
                'status_halal' => 'Tersertifikasi Halal',
            ]
        );

        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'jam_buka'     => 'required|string|max:100',
            'no_whatsapp'  => 'required|string|max:20',
            'status_halal' => 'required|string|max:100',
        ]);

        $pengaturan = PengaturanWeb::first();
        $pengaturan->update($validated);

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan toko berhasil diperbarui!');
    }
}