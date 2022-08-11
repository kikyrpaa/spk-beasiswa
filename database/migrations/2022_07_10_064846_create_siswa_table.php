<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->integerIncrements('id_siswa');
            $table->string('nama', 255);
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->float('nilai_rapot');
            $table->string('foto_siswa')->nullable(true);
            $table->string('sertifikat_prestasi')->nullable(true);
            $table->integer('juara_sertifikat_prestasi')->nullable(true);
            $table->enum('tingkat_sertifikat_prestasi', ['kota', 'provinsi', 'nasional', 'internasional'])->nullable(true);
            $table->boolean('status_sertifikat_prestasi')->default(false);
            $table->string('foto_rapot')->nullable(true);
            $table->string('sertifikat_hafidh')->nullable(true);
            $table->integer('juz_sertifikat_hafidh')->nullable(true);
            $table->boolean('status_sertifikat_hafidh')->default(false);
            $table->boolean('status')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('siswa');
    }
}
