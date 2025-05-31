<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
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

    public function formObat() {
        session(['type' => 'obat']);
        return view('obat.show');
    }

    public function submitObat(Request $request) {
        $validated = $request->validate([
            'Id_Pendaftar' => 'required|integer',
            'nama' => 'required',
        ]);

        $obat = Obat::create($validated);
        session(['obat' => $obat, 'type' => 'obat']);

        
        return redirect()->route('form.obat')
                         ->with('success', 'Selamat Anda Mendapat Nomor Antrian :');
    }


    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

         
        session()->forget('pendaftar');

        return redirect()->route('form.pendaftaran')->with('success', 'Data berhasil dihapus');

         $obat = Obat::findOrFail($id);
        $obat->delete();

         
        session()->forget('obat');

        return redirect()->route('form.obat')->with('success', 'Data berhasil dihapus');
    }
}
