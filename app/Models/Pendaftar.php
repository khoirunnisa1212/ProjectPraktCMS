<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftar'; // sesuai nama tabel

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'bb',
        'tb',
        'telepon',
        'email',
    ];

    // Relasi: Pendaftar memiliki banyak Obat
    public function obat()
    {
        return $this->hasMany(Obat::class, 'pendaftar_id');
    }
}

