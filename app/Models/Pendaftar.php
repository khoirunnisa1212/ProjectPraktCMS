<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftar'; 

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'bb',
        'tb',
        'telepon',
        'email',
        'akun_id' 
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    public function obat()
    {
        return $this->hasMany(Obat::class, 'pendaftar_id');
    }
}
