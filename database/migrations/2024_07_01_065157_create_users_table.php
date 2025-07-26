<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Menetapkan kolom 'id' sebagai auto-increment
            $table->string('username', 20);
            $table->string('password', 250);
            $table->enum('role_user', ['admin', 'user']);
            $table->string('keyword', 20)->nullable();
            $table->timestamp('register_user')->useCurrent();
            $table->string('photo', 20)->default('avatar.png');
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
        Schema::dropIfExists('users');
    }
}
