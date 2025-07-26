<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbWaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_wali', function (Blueprint $table) {
            $table->id('id_wali'); // Menggunakan auto-increment
            $table->unsignedBigInteger('id_siswa'); // Menyimpan ID dari tabel tb_siswa
            $table->string('nama_wali', 50);
            $table->string('no_wa', 15); // Nomor WhatsApp

            // Mendefinisikan foreign key untuk relasi dengan tb_siswa
            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('tb_siswa')
                  ->onDelete('cascade');

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
        Schema::table('tb_wali', function (Blueprint $table) {
            $table->dropForeign(['id_siswa']);
        });

        Schema::dropIfExists('tb_wali');
    }
}
