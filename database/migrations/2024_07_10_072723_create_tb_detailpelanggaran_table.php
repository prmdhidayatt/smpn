<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailpelanggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detailpelanggaran', function (Blueprint $table) {
            $table->id('id_detail'); // Menggunakan auto-increment
            $table->unsignedBigInteger('id_kasus'); // Menyimpan ID dari tabel tb_kasuspelangaran
            $table->unsignedBigInteger('id_jenispelanggaran'); // Menyimpan ID dari tabel tb_jenispelanggaran
            $table->text('bukti');
            $table->date('tanggal');

            // Mendefinisikan foreign key untuk relasi dengan tabel tb_kasuspelangaran
            $table->foreign('id_kasus')
                  ->references('id_kasus')
                  ->on('tb_kasuspelangaran')
                  ->onDelete('cascade');

            // Mendefinisikan foreign key untuk relasi dengan tabel tb_jenispelanggaran
            $table->foreign('id_jenispelanggaran')
                  ->references('id_jenispelanggaran')
                  ->on('tb_jenispelanggaran')
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
        Schema::table('tb_detailpelanggaran', function (Blueprint $table) {
            $table->dropForeign(['id_kasus']);
            $table->dropForeign(['id_jenispelanggaran']);
        });

        Schema::dropIfExists('tb_detailpelanggaran');
    }
}
