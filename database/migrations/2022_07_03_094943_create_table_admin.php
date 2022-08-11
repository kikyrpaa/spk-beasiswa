<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->integerIncrements('id_admin');
            $table->string('nama', 255);
            $table->string('username', 255)->unique();
            $table->string('password',255);
            $table->text('alamat');
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->enum('jabatan', ['admin', 'pengurus']);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_admin');
    }
}
