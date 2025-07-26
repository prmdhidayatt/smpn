<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nisn', 20)->unique();
            $table->string('nama_siswa', 50);
            $table->enum('jk_siswa', ['Laki-laki', 'Perempuan']);
            $table->unsignedBigInteger('id_kelas');
            $table->string('alamat');
            $table->string('tahun_ajaran', 10);
            $table->string('no_wa')->nullable(); // Kolom nomor WhatsApp (boleh kosong)

            $table->foreign('id_kelas')
                ->references('id_kelas')
                ->on('tb_kelas')
                ->onDelete('cascade');

            $table->timestamps();
        });
        // Schema::table('tb_siswa', function (Blueprint $table) {
        //     $table->string('no_wa')->nullable()->after('tahun_ajaran');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_siswa', function (Blueprint $table) {
            $table->dropForeign(['id_kelas']);
        });

        Schema::dropIfExists('tb_siswa');
        Schema::table('tb_siswa', function (Blueprint $table) {
            $table->dropColumn('no_wa');
        });
    }
}
