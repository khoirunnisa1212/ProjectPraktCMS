<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Obat;

class ObatController extends Controller
{
    public function formPendaftaran() {
        session(['type' => 'pendaftaran']);
        return view('obat.show');
    }
    
    public function submitPendaftaran(Request $request) {
        $pendaftar = Pendaftar::create($request->all());
        session(['pendaftar' => $pendaftar, 'type' => 'pendaftaran']);
        return redirect()->route('form.pendaftaran');
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
}



