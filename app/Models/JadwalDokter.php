<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter'; // <- ini penting!

    protected $fillable = [
        'nama_dokter', 'hari', 'shift', 'jam_mulai', 'jam_selesai'
    ];

    public $timestamps = false; // opsional kalau tidak pakai created_at & updated_at
}
