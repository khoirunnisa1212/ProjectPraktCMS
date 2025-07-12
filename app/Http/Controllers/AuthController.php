<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Akun;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $akun = Akun::where('email', $request->email)->first();

        if ($akun && Hash::check($request->password, $akun->password)) {
            Auth::login($akun);
            if ($akun->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('obat.index');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:akun,email'],
        'password' => ['required', 'min:6', 'confirmed'],
    ]);

    \App\Models\Akun::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'pendaftar', // default role
    ]);

    return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
