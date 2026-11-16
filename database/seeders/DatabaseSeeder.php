<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\PengaturanWeb;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'nama' => 'Admin Dapur Geprek',
            'email' => 'admin@dapurgeprek.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun Pelanggan Contoh + Profil
        $userPelanggan = User::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'id_user' => $userPelanggan->id_user,
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Umban Sari No. 15, Rumbai, Pekanbaru',
        ]);

        // 3. Pengaturan Web Toko
        PengaturanWeb::create([
            'jam_buka' => '08:00 - 20:00 WIB (Setiap Hari)',
            'no_whatsapp' => '6281234567890',
            'status_halal' => 'Tersertifikasi Halal MUI',
        ]);

        // 4. Data Dummy Katalog Menu Katering
        $menus = [
            [
                'nama_menu' => 'Paket Kotak Ayam Geprek Original',
                'kategori_menu' => 'Paket Kotak',
                'harga' => 18000,
                'stok_porsi' => 100,
                'deskripsi' => 'Nasi putih hangat, ayam geprek krispi sambal bawang khas (Level 1-5), lalapan segar, dan tahu/tempe goreng.',
                'status_menu' => 'Tersedia',
            ],
            [
                'nama_menu' => 'Paket Kotak Ayam Geprek Mozzarella',
                'kategori_menu' => 'Paket Kotak',
                'harga' => 24000,
                'stok_porsi' => 75,
                'deskripsi' => 'Ayam geprek pedas gurih dengan lelehan keju mozzarella bakar di atasnya, lengkap dengan nasi dan lalapan.',
                'status_menu' => 'Tersedia',
            ],
            [
                'nama_menu' => 'Paket Kotak Ayam Geprek Sambal Matah',
                'kategori_menu' => 'Paket Kotak',
                'harga' => 20000,
                'stok_porsi' => 80,
                'deskripsi' => 'Perpaduan ayam geprek renyah dengan irisan segar sambal matah kecombrang khas Bali.',
                'status_menu' => 'Tersedia',
            ],
            [
                'nama_menu' => 'Paket Tumpeng Mini Ayam Geprek',
                'kategori_menu' => 'Paket Acara',
                'harga' => 32000,
                'stok_porsi' => 40,
                'deskripsi' => 'Nasi kuning tumpeng mini dengan lauk ayam geprek suwir pedas, perkedel, telur balado, dan urap sayur.',
                'status_menu' => 'Tersedia',
            ],
            [
                'nama_menu' => 'Tahu & Tempe Geprek Krispi (Isi 4)',
                'kategori_menu' => 'Lauk Tambahan',
                'harga' => 8000,
                'stok_porsi' => 120,
                'deskripsi' => 'Tahu dan tempe goreng tepung krispi digeprek dengan sambal bawang pedas.',
                'status_menu' => 'Tersedia',
            ],
            [
                'nama_menu' => 'Es Teh Manis / Jeruk Peras Cup',
                'kategori_menu' => 'Minuman',
                'harga' => 5000,
                'stok_porsi' => 150,
                'deskripsi' => 'Minuman segar pendamping paket katering acara maupun rapat kantor.',
                'status_menu' => 'Tersedia',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}

