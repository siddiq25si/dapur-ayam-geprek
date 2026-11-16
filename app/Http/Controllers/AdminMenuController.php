<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::latest('id_menu')
            ->filter($request->only(['search', 'kategori']))
            ->paginate(10)
            ->withQueryString();

        $kategoriList = ['Paket Kotak', 'Paket Acara', 'Lauk Tambahan', 'Minuman'];

        return view('admin.menu.index', compact('menus', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList = ['Paket Kotak', 'Paket Acara', 'Lauk Tambahan', 'Minuman'];
        return view('admin.menu.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu'     => 'required|string|max:150',
            'kategori_menu' => 'required|string|max:100',
            'harga'         => 'required|integer|min:0',
            'stok_porsi'    => 'required|integer|min:0',
            'status_menu'   => 'required|in:Tersedia,Habis',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('menu', 'public');
        }

        Menu::create($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu katering baru berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        $kategoriList = ['Paket Kotak', 'Paket Acara', 'Lauk Tambahan', 'Minuman'];
        return view('admin.menu.edit', compact('menu', 'kategoriList'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama_menu'     => 'required|string|max:150',
            'kategori_menu' => 'required|string|max:100',
            'harga'         => 'required|integer|min:0',
            'stok_porsi'    => 'required|integer|min:0',
            'status_menu'   => 'required|in:Tersedia,Habis',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
                Storage::disk('public')->delete($menu->foto);
            }
            $validated['foto'] = $request->file('foto')->store('menu', 'public');
        }

        $menu->update($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Data menu "' . $menu->nama_menu . '" berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
            Storage::disk('public')->delete($menu->foto);
        }

        $namaMenu = $menu->nama_menu;
        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu "' . $namaMenu . '" berhasil dihapus!');
    }
}