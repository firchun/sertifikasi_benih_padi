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
        Schema::create('sertifikasi_vegetatifs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sertifikasi');
            $table->enum('sesuai_varietas', ['Ya', 'Tidak']);
            $table->string('hama_penyakit');
            $table->string('kemurnian');
            $table->string('pemeriksaan');
            $table->json('campuran_varietas');
            $table->string('keadaan_rumput');
            $table->float('taksiran_hasil')->nullable();
            $table->enum('kesimpulan', ['Lulus', 'Tidak Lulus']);
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
        Schema::dropIfExists('sertifikasi_vegetatifs');
    }
};
