<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class AdminPelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggans = Pelanggan::with('user')
            ->withCount('pesanan')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('no_hp', 'like', '%' . $search . '%')
                      ->orWhere('alamat', 'like', '%' . $search . '%')
                      ->orWhereHas('user', function ($u) use ($search) {
                          $u->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                      });
                });
            })
            ->latest('id_pelanggan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pelanggan.index', compact('pelanggans'));
    }
}