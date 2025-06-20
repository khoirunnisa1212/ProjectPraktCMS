<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Obat;
use App\Models\Pendaftar;


class ObatController extends Controller
{
    public function formPendaftaran() {
        session(['type' => 'pendaftaran']);
        return view('obat.show');
    }

    public function submitPendaftaran(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'bb' => 'required|integer',
            'tb' => 'required|integer',
            'telepon' => 'required',
            'email' => 'required|email'
        ]);

        $pendaftar = Pendaftar::create($validated);
        session(['pendaftar' => $pendaftar, 'type' => 'pendaftaran']);

        
        return redirect()->route('form.pendaftaran')
                         ->with('success', 'Data Pendaftar berhasil ditambahkan');
    }

        public function formCekPendaftar()
    {
        session(['type' => 'cek']);
        return view('obat.cek');
    }

    public function cekPendaftar(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        try {
            $data = Pendaftar::findOrFail($request->id);
            return view('obat.cek', compact('data'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('form.cek.pendaftar')->withErrors('Pendaftar tidak ditemukan.');
        }
    }

    public function formObat() {
        session(['type' => 'obat']);
        return view('obat.show');
    }

    public function submitObat(Request $request) {
       {
    // Validasi sederhana (boleh ditingkatkan)
    $request->validate([
        'id_pendaftar' => 'required',
        'nama' => 'required'
    ]);

    // Simpan data ke database Oracle
    $obat = Obat::create([
        'id_pendaftar' => $request->id_pendaftar,
        'nama' => $request->nama
    ]);

    // Buat object untuk session
    $antrian = (object) [
        'id' => $obat->id,
        'Id_Pendaftar' => $obat->id_pendaftar,
        'nama' => $obat->nama
    ];

    // Simpan ke session
    session(['obat' => $antrian]);

    // Redirect agar session('obat') bisa dibaca di Blade
    return redirect()->back()->with('success', 'Data antrian berhasil disimpan dan diambil.');
}

        return redirect()->route('obat.index');
    }


    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

         
        session()->forget('pendaftar');

        return redirect()->route('form.pendaftaran')->with('success', 'Data berhasil dihapus');
    }
}
