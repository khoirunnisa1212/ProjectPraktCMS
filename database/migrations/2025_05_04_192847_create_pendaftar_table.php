<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id(); // id_pendaftar
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->float('bb'); // berat badan dalam kg
            $table->float('tb'); // tinggi badan dalam cm
            $table->string('telepon');
            $table->string('email');
            $table->timestamps();
        });
    }

    private function callSeeder(): void
    {
        // Jalankan seeder secara manual
        (new ObatSeeder)->run();
    }

    public function down()
    {
        Schema::dropIfExists('pendaftar');
    }
}
