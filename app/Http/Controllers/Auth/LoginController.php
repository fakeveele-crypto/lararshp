<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role; 
// Jika Anda menggunakan trait AuthenticatesUsers, tambahkan:
// use Illuminate\Foundation\Auth\AuthenticatesUsers; 

class LoginController extends Controller
{
    // Jika Anda menggunakan trait AuthenticatesUsers, uncomment baris di bawah:
    // use AuthenticatesUsers; 

    public function __construct()
    {
        // Hanya user yang belum login yang bisa mengakses halaman login, kecuali logout
        $this->middleware('guest')->except('logout');
    }

    // Fungsi untuk menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login'); // Memanggil view auth.login [cite: 226]
    }

    // Fungsi untuk memproses permintaan login
    public function login(Request $request)
    {
        // 1. VALIDASI
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // [cite: 231]
            'password' => 'required|min:6', // [cite: 232]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // [cite: 234, 235, 236]
        }

        // 2. MENCARI USER DENGAN ROLE
        $user = User::with('roleUsers.role') // Memuat relasi role melalui roleUsers
            ->where('email', $request->input('email'))
            ->first();

        // 3. CEK USER
        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.']) // [cite: 242, 244]
                ->withInput();
        }

        // 4. CEK PASSWORD
        if (!Hash::check($request->password, $user->password)) { // [cite: 247, 553]
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.']) // [cite: 249, 555]
                ->withInput();
        }

        // 5. AMBIL DATA ROLE AKTIF UNTUK SESI
        $activeRoleUser = $user->roleUsers->where('status', 1)->first();
        if (!$activeRoleUser) {
            return redirect()->back()
                ->withErrors(['email' => 'User tidak memiliki role aktif.'])
                ->withInput();
        }
        $userRoleID = $activeRoleUser->idrole;
        $namaRole = $activeRoleUser->role->nama_role ?? 'User';
        
        // 6. LOGIN UTAMA DAN SIMPAN SESI
        Auth::login($user); // [cite: 252, 558]

        // Simpan semua data penting ke session
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $userRoleID ?? 'user',
            'user_role_name' => $namaRole,
            'user_status' => 'active',
        ]);

        // 7. PENGARAHAN BERDASARKAN ROLE (SWITCH CASE)
        // [cite: 569]
        switch ($userRoleID) {
            case '1':
                // Role 1: Administrator
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!'); // [cite: 570, 571]
            case '2':
                // Role 2: Dokter
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!'); // [cite: 572]
            case '3':
                // Role 3: Perawat
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!'); // [cite: 573]
            case '4':
                // Role 4: Resepsionis
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!'); // [cite: 574]
            case '5':
                // Role 5: Pemilik
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
        }
    }

    // Fungsi untuk memproses logout
    public function logout(Request $request)
    {
        Auth::logout(); // [cite: 265]
        $request->session()->invalidate(); // [cite: 266]
        $request->session()->regenerateToken(); // [cite: 267]

        return redirect('/')->with('success', 'Logout berhasil!'); // [cite: 268]
    }
}