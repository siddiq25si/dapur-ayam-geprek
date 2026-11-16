<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Login
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }

        return view('auth.login');
    }

    // Memproses form Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang kembali, ' . Auth::user()->nama . '!');
            }

            return redirect()->route('home')
                ->with('success', 'Login berhasil! Selamat datang, ' . Auth::user()->nama . '.');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    // Menampilkan halaman Register Pelanggan
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    // Memproses pendaftaran Pelanggan baru
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // 1. Simpan ke tabel users
        $user = User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pelanggan',
        ]);

        // 2. Simpan detail profil ke tabel pelanggan
        Pelanggan::create([
            'id_user' => $user->id_user,
            'no_hp'   => $request->no_hp,
            'alamat'  => $request->alamat,
        ]);

        // 3. Langsung login otomatis setelah daftar
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', 'Pendaftaran berhasil! Akun pelanggan Anda siap digunakan.');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
