<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->integerIncrements('id_beasiswa');
            $table->string('nama_beasiswa', 255);
            $table->text('deskripsi');
            $table->string('semester', 50);
            $table->string('tahun_beasiswa', 255);
            $table->string('pemberi_beasiswa', 50);
            $table->date('tanggal_beasiswa');
            $table->integer('jumlah_penerima');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beasiswa');
    }
}
