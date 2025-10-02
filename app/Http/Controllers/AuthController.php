<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- FUNGSI UNTUK REGISTER ---
    public function register(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // 2. Buat user baru (role otomatis 'user')
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Aturan penting: Semua pendaftaran baru adalah 'user'
        ]);

        // 3. Login user yang baru dibuat
        #Auth::login($user);

        // 4. Redirect ke halaman utama
        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login untuk melanjutkan.');
    }

    // --- FUNGSI UNTUK LOGIN ---
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba autentikasi user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan

            // 3. Cek role dan redirect
            if (auth()->user()->role == 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/');
        }

        // 4. Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // --- FUNGSI UNTUK LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}