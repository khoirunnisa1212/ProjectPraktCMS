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
            $table->timestamps();
        });
    }

    private function callSeeder(): void
    {
        (new ObatSeeder)->run();
    }

    public function down()
    {
        Schema::dropIfExists('obat');
    }
}
