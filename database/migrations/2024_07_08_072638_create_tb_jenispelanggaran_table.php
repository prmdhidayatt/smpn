<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbJenispelanggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jenispelanggaran', function (Blueprint $table) {
            $table->id('id_jenispelanggaran'); // Menggunakan auto-increment
            $table->string('nama_pelanggaran', 100);
            $table->string('kategori', 50);
            $table->integer('poin');
            $table->text('sanksi'); // Menggunakan text untuk sanksi yang panjang
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_jenispelanggaran');
    }
}
