<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Obat;
use App\Models\RiwayatPasien;
use App\Models\Image;
use App\Models\JadwalDokter;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $pendaftars = \App\Models\Pendaftar::query();

        if ($search) {
            $searchLower = strtolower($search);

            if (is_numeric($search)) {
                $pendaftars->where(function ($query) use ($search, $searchLower) {
                    $query->where('id', $search)
                        ->orWhereRaw('LOWER(nama) LIKE ?', ["%{$searchLower}%"]);
                });
            } else {
                $pendaftars->whereRaw('LOWER(nama) LIKE ?', ["%{$searchLower}%"]);
            }
        }

        $pendaftars = $pendaftars->orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('pendaftars'));
    }

        public function edit($id)
        {
            $pendaftar = Pendaftar::findOrFail($id);
            return view('admin.edit', compact('pendaftar'));
        }

        public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);


    if ($pendaftar->akun_id) {
        $akun = \App\Models\Akun::find($pendaftar->akun_id);
        if ($akun) {
            $akun->sudah_daftar = false;
            $akun->save();
        }
    }

    $pendaftar->delete();


        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus');
    }

    public function detail($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $riwayatObat = Obat::where('Id_Pendaftar', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayat = RiwayatPasien::where('id_pendaftar', $id)
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();

        return view('admin.detail', compact('pendaftar', 'riwayatObat', 'riwayat'));
    }

    public function storeRiwayat(Request $request, $id)
    {
        $request->validate([
            'penyakit' => 'required|string|max:255',
            'diagnosa' => 'required|string',
            'obat' => 'nullable|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
        ]);

        RiwayatPasien::create([
            'id_pendaftar' => $id,
            'penyakit' => $request->penyakit,
            'diagnosa' => $request->diagnosa,
            'obat' => $request->obat,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
        ]);

        return redirect()->route('admin.pendaftar.edit', $id)->with('success', 'Riwayat berhasil ditambahkan.');
    }

    public function images()
    {
        $images = Image::latest()->get(); 
        return view('admin.images', compact('images'));
    }

    public function jadwalDokterIndex()
    {
        $jadwals = JadwalDokter::orderBy('hari')->orderBy('shift')->get();
        return view('admin.jadwal', compact('jadwals'));
    }

    public function jadwalDokterStore(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'shift' => 'required|in:Pagi,Siang,Sore',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalDokter::create($request->all());

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function hapusJadwal($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
