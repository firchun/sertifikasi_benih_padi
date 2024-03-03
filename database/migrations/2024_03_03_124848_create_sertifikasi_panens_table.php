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
        Schema::create('sertifikasi_panens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sertifikasi');
            $table->float('luas_pemeriksaan');
            $table->float('luas_panen');
            $table->float('hasil_panen');
            $table->json('peralatan_panen');
            $table->enum('campuran', ['Ada', 'Tidak Ada']);
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
        Schema::dropIfExists('sertifikasi_panens');
    }
};
