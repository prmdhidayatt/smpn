<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbWalikelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_walikelas', function (Blueprint $table) {
            $table->id('id_walikelas'); // Menggunakan auto-increment
            $table->string('nip_walikelas', 20);
            $table->string('nama_walikelas', 50);
            $table->string('jabatan', 30);
            $table->enum('jk_walikelas', ['Laki-laki', 'Perempuan']);
            $table->string('tahun_ajaran', 10);
            $table->unsignedBigInteger('id_kelas')->nullable(); // Menyimpan ID dari tb_kelas

            // Mendefinisikan foreign key untuk relasi dengan tb_kelas
            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('tb_kelas')
                  ->onDelete('set null');
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_walikelas');
    }
}
