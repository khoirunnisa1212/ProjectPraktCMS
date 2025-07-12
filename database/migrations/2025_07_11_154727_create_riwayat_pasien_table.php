<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('riwayat_pasien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pendaftar');
            $table->string('penyakit');
            $table->text('diagnosa');
            $table->string('obat')->nullable();
            $table->date('tanggal_pemeriksaan');
            $table->timestamps();

            $table->foreign('id_pendaftar')->references('id')->on('pendaftar')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_pasien');
    }
};
