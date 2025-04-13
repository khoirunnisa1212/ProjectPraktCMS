<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('obat\index', compact('obats'));
    }

    public function show($id)
    {
        $obat = Obat::find($id);
        if (!$obat) {
            abort(404);
        }
        return view('obat\show', compact('obat'));
    }
    public function submitUlasan(Request $request, $id)
{
    // Bisa validasi di sini kalau mau
    // Simulasi: ulasan diterima (tidak disimpan ke database)
    
    return redirect()->back()->with('success', 'Ulasan sudah terkirim.');
}
}

