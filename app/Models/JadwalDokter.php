<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter'; 

    protected $fillable = [
        'nama_dokter', 'hari', 'shift', 'jam_mulai', 'jam_selesai'
    ];

    public $timestamps = false;
}
