<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kelas', function (Blueprint $table) {
            $table->id('id_kelas'); // Menggunakan auto-increment
            $table->string('nama_kelas', 50);
            $table->unsignedBigInteger('id_tahunajaran'); // Menambahkan kolom id_tahunajaran untuk relasi
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key ke tabel tb_tahunajaran
            $table->foreign('id_tahunajaran')->references('id_tahunajaran')->on('tb_tahunajaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kelas');
    }
}
