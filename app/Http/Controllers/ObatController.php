<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Obat;
use App\Models\Pendaftar;


class ObatController extends Controller
{
    public function index()
    {
        return view('obat.index');
    }

    public function formPendaftaran() {
        session(['type' => 'pendaftaran']);
        return view('obat.show');
    }

public function submitPendaftaran(Request $request)
{
    try {
        $validated = $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'bb' => 'required|integer',
            'tb' => 'required|integer',
            'telepon' => 'required|numeric',
            'email' => 'required|email|unique:pendaftar,email'
        ]);

        $pendaftar = Pendaftar::create($validated);
        session(['pendaftar' => $pendaftar, 'type' => 'pendaftaran']);

        // Logging info
        Log::info('Pendaftar berhasil disimpan', [
            'id' => $pendaftar->id,
            'nama' => $pendaftar->nama
        ]);

        return redirect()->route('form.pendaftaran')
                         ->with('success', 'Data Pendaftar berhasil disimpan');
    } catch (\Exception $e) {
        // Logging error
        Log::error('Error saat menyimpan data pendaftar: ' . $e->getMessage());

        return redirect()->back()
                         ->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
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

    public function edit($id)
    {
        $data = Pendaftar::findOrFail($id);
        return view('obat.edit', compact('data'));
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date|before:today',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'bb' => 'required|numeric|min:30|max:200',
        'tb' => 'required|numeric|min:30|max:250',
        'telepon' => 'required',
        'email' => 'required|email'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $pendaftar = Pendaftar::findOrFail($id);
    $pendaftar->nama = $request->nama;
    $pendaftar->tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
    $pendaftar->jenis_kelamin = $request->jenis_kelamin; 
    $pendaftar->bb = $request->bb;
    $pendaftar->tb = $request->tb;
    $pendaftar->telepon = $request->telepon;
    $pendaftar->email = $request->email;
    $pendaftar->save();

    return redirect()->route('obat.cek', ['id' => $id])->with('success', 'Data berhasil diperbarui.');
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
