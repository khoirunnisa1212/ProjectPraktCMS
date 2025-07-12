<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable;

    protected $table = 'akun'; // nama tabel custom

    protected $fillable = [
    'nama', 'email', 'password', 'role' ,'sudah_daftar'
];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pendaftar()
{
    return $this->hasOne(Pendaftar::class);
}

}
