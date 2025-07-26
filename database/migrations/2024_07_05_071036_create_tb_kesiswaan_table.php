<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKesiswaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kesiswaan', function (Blueprint $table) {
            $table->id('id_kesiswaan'); // Menggunakan auto-increment
            $table->string('nip', 20);
            $table->string('nama_kesiswaan', 50);
            $table->enum('jk_kesiswaan', ['L', 'P']); // Jenis kelamin: Laki-laki atau Perempuan
            $table->unsignedBigInteger('id_user'); // Menyimpan ID dari tabel users

            // Mendefinisikan foreign key untuk relasi dengan tabel users
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
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
        Schema::table('tb_kesiswaan', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
        });

        Schema::dropIfExists('tb_kesiswaan');
    }
}
