<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->float('bb'); 
            $table->float('tb'); 
            $table->string('telepon');
            $table->string('email');
            $table->foreignId('akun_id')->constrained('akun')->onDelete('cascade');
            $table->timestamps();
        });
    }

    private function callSeeder(): void
    {
        (new ObatSeeder)->run();
    }

    public function down()
    {
        Schema::dropIfExists('pendaftar');
    }
}
