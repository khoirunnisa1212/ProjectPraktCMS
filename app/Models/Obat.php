<?php

namespace App\Models;

class Obat
{
    // Fungsi "seolah-olah" mengambil dari database
    protected static function getDummyData()
    {
        return [
            ['id' => 1, 'title' => 'Nama Obat'],
            ['id' => 2, 'title' => 'Jenis Obat'],
            ['id' => 3, 'title' => 'Ulasan'],
        ];
    }

    // Mengambil semua data
    public static function all()
    {
        return self::getDummyData();
    }

    // Mencari satu data berdasarkan id
    public static function find($id)
    {
        $obats = self::getDummyData();
        foreach ($obats as $obat) {
            if ($obat['id'] == $id) {
                return $obat;
            }
        }
        return null;
    }
}
