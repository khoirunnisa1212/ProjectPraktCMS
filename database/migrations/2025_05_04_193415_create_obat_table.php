<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    public function up()
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id(); // id_obat
            $table->unsignedBigInteger('pendaftar_id');
            $table->string('nama'); // nama obat
            $table->date('tanggal_kedaluwarsa'); // tanggal exp
            $table->timestamps();

            // Foreign key ke pendaftar
            $table->foreign('pendaftar_id', 'fk_obat_pendaftar')
                  ->references('id')->on('pendaftar')->onDelete('cascade');

            $table->primary('id', 'pk_obat_id');

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
