<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    public function up()
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftar');
            $table->string('nama');
            // Tambahkan kolom lain sesuai kebutuhan
        });
    }

    private function callSeeder(): void
    {
        // Jalankan seeder secara manual
        (new ObatSeeder)->run();
    }


    public function down()
    {
        Schema::dropIfExists('obat');
    }
}
