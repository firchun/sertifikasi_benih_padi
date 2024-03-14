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
        Schema::create('sertifikasi_pendahuluans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sertifikasi');
            $table->string('tanaman_utara');
            $table->string('tanaman_selatan');
            $table->string('tanaman_timur');
            $table->string('tanaman_barat');
            $table->string('bekas_tanam')->nullable();
            $table->foreignId('id_kelas_benih_sebelumnya');
            $table->foreignId('id_varietas_sebelumnya');
            $table->string('bekas_bero')->nullable();
            $table->enum('kesimpulan', ['Memenuhi', 'Tidak']);
            $table->text('catatan')->nullable();

            $table->foreign('id_sertifikasi')->references('id')->on('sertifikasis');
            $table->foreign('id_kelas_benih_sebelumnya')->references('id')->on('kelas_benihs');
            $table->foreign('id_varietas_sebelumnya')->references('id')->on('varietas');
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
        Schema::dropIfExists('sertifikasi_pendahuluans');
    }
};
