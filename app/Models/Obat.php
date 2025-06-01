<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat'; // nama tabel Oracle
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pendaftar',
        'nama'
    ];

    public $timestamps = false; // kalau tabel Oracle kamu tidak punya kolom created_at/updated_at

}
