<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('nik')->unique()->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis_kel')->nullable();
            $table->string('tempat_lhr')->nullable();
            $table->string('tanggal_lhr')->nullable();
            $table->string('no_hp')->nullable();
            $table->bigInteger('school_id')->unsigned()->nullable();
            $table->string('jenjang')->nullable();
            $table->string('golongan')->nullable();
            $table->string('sertifikasi')->nullable();
            $table->string('gambar_profile')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_details');
    }
};
