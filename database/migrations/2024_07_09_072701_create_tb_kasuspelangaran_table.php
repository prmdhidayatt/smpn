<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKasuspelangaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kasuspelangaran', function (Blueprint $table) {
            $table->id('id_kasus'); // Menggunakan auto-increment
            $table->unsignedBigInteger('id'); // Menyimpan ID dari tabel users
            $table->unsignedBigInteger('id_siswa'); // Menyimpan ID dari tabel tb_siswa
           
            $table->string('tahun_ajaran', 10);
            $table->integer('total_poin');

            // Mendefinisikan foreign key untuk relasi dengan tabel users
            $table->foreign('id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Mendefinisikan foreign key untuk relasi dengan tabel tb_siswa
            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('tb_siswa')
                  ->onDelete('cascade');

            $table->timestamps(); // Kolom created_at dan updated_at
        });
        Schema::table('tb_kasuspelangaran', function (Blueprint $table) {
            $table->string('no_wa', 20)->nullable()->after('id_siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_kasuspelangaran', function (Blueprint $table) {
            $table->dropForeign(['id']);
            $table->dropForeign(['id_siswa']);
        });

        Schema::dropIfExists('tb_kasuspelangaran');
        Schema::table('tb_kasuspelangaran', function (Blueprint $table) {
            $table->dropColumn('no_wa');
        });
    }
}
