<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    public function up()
    {
       Schema::create('obat', function (Blueprint $table) {
            $table->id(); // Nomor Antrian
            $table->unsignedBigInteger('Id_Pendaftar');
            $table->string('nama');
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
