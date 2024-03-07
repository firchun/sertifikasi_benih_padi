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
        Schema::create('sertifikasi_labs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sertifikasi');
            $table->string('nomor_induk');
            $table->string('musim_tanam');
            $table->string('nomor_kelompok');
            $table->date('tanggal_panen');
            $table->date('tanggal_label');
            $table->date('tanggal_selesai_pengujian');
            $table->float('volume');
            //mutu benih
            $table->float('campuran_varietas_lain');
            $table->float('kadar_air');
            $table->float('benih_murni');
            $table->float('kotoran_benih');
            $table->float('daya_berkecambah');
            $table->float('biji_gulma');
            $table->float('kesehatan_benih')->nullable();

            $table->timestamps();

            $table->foreign('id_sertifikasi')->references('id')->on('sertifikasis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sertifikasi_labs');
    }
};
