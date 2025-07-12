<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('jadwal_dokter', function (Blueprint $table) {
        $table->id();
        $table->string('nama_dokter');
        $table->string('hari');
        $table->string('shift'); 
        $table->string('jam_mulai'); 
        $table->string('jam_selesai');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
