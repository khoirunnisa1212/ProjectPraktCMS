<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Obat;
use App\Models\Pendaftar;
use App\Models\RiwayatPasien;
use App\Models\JadwalDokter;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->has('clear')) {
            session()->forget(['pendaftar', 'type']);
        }

        return view('obat.index');
    }

    public function formPendaftaran(Request $request)
    {
    
        session(['type' => 'pendaftaran']);

        $sudahDaftar = Pendaftar::where('akun_id', auth()->id())->exists();

        $pendaftarId = session('pendaftar_id');
        $pendaftar = null;

        if ($pendaftarId) {
            $pendaftar = Pendaftar::find($pendaftarId);
        }

        return view('obat.show', compact('sudahDaftar', 'pendaftar'));
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

            $akun = auth()->user();

            $pendaftarSebelumnya = Pendaftar::where('akun_id', $akun->id)->first();
            if ($pendaftarSebelumnya) {
                return redirect()->route('obat.index')
                                ->with('info', 'Kamu sudah pernah mendaftar.');
            }

            $pendaftar = Pendaftar::create([
                ...$validated,
                'akun_id' => $akun->id,
            ]);

            $akun->update(['sudah_daftar' => true]);

            $request->session()->put('pendaftar', $pendaftar); 
            $request->session()->put('type', 'pendaftaran');

            return redirect()->route('form.pendaftaran');

        } catch (\Exception $e) {
            Log::error('Error saat menyimpan data pendaftar: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
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

        $akunId = Auth::id();
        $pendaftar = Pendaftar::where('id', $request->id)
                            ->where('akun_id', $akunId)
                            ->first();

        if (!$pendaftar) {
            return redirect()->route('form.cek.pendaftar')->withErrors('Data tidak ditemukan atau bukan milik Anda.');
        }

        return view('obat.cek', ['data' => $pendaftar]);
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

    public function formObat(Request $request)
    {
        session(['type' => 'obat']);
        $sudahDaftar = true;
        return view('obat.show', compact('sudahDaftar'));  
    }

    public function submitObat(Request $request) 
    {
       {
        $request->validate([
            'id_pendaftar' => 'required',
            'nama' => 'required'
        ]);

        $obat = Obat::create([
            'id_pendaftar' => $request->id_pendaftar,
            'nama' => $request->nama
        ]);


        $antrian = (object) [
            'id' => $obat->id,
            'Id_Pendaftar' => $obat->id_pendaftar,
            'nama' => $obat->nama
        ];

            session(['obat' => $antrian]);

            return redirect()->back()->with('success', 'Data antrian berhasil disimpan dan diambil.');
        }
        return redirect()->route('obat.index');
    }

    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

        session()->forget(['pendaftar', 'pendaftar_id', 'type']);

        session()->flash('type', 'pendaftaran');

        return redirect()->route('form.pendaftaran')->with('success', 'Data berhasil dihapus');
    }

    public function semuaRiwayat()
    {
        $userId = auth()->id();

        $riwayats = RiwayatPasien::whereHas('pendaftar', function ($query) use ($userId) {
            $query->where('akun_id', $userId);
        })
        ->orderBy('tanggal_pemeriksaan', 'desc')
        ->get();

        return view('obat.riwayat', compact('riwayats'));
    }

    public function jadwalDokterPasien()
    {
        $jadwals = JadwalDokter::orderBy('hari')->orderBy('shift')->get();
        return view('obat.jadwal', compact('jadwals'));
    }

}
