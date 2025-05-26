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
        // Simpan data pendaftar di session untuk tampil detail di view yang sama
        session(['pendaftar' => $pendaftar, 'type' => 'pendaftaran']);

        // Redirect ke form pendaftaran (obat.show) dengan data detail di session
        return redirect()->route('form.pendaftaran')
                         ->with('success', 'Data Pendaftar berhasil ditambahkan');
    }

    public function formObat() {
        session(['type' => 'obat']);
        return view('obat.show');
    }

    public function submitObat(Request $request) {
        $data = Obat::where('id_pendaftar', $request->id_pendaftar)
                    ->where('id_transaksi', $request->id_transaksi)
                    ->get();

        session(['obat' => $data, 'type' => 'obat']);
        return redirect()->route('form.obat');
    }

    // Hapus data pendaftar
    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

            // Hapus session data pendaftar agar detailnya tidak tampil lagi di view
        session()->forget('pendaftar');

        return redirect()->route('form.pendaftaran')->with('success', 'Data berhasil dihapus');
    }
}
