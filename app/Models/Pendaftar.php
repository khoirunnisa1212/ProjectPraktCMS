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
        'akun_id' // tambahkan agar bisa diisi saat create()
    ];

    // Relasi: Pendaftar dimiliki oleh satu akun
    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    // Relasi: Pendaftar memiliki banyak Obat
    public function obat()
    {
        return $this->hasMany(Obat::class, 'pendaftar_id');
    }
}
