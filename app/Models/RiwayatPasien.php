<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPasien extends Model
{
    protected $table = 'riwayat_pasien';

    protected $fillable = [
        'id_pendaftar',
        'penyakit',
        'diagnosa',
        'obat',
        'tanggal_pemeriksaan',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'id_pendaftar');
    }
}
