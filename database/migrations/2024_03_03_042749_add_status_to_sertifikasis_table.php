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
        Schema::table('sertifikasis', function (Blueprint $table) {
            $table->enum('status', ['Proses Permohonan', 'Pemerikasaan Lapangan Pendahuluan', 'Pemeriksaan Fase Vegetatif', 'Pemerikasan Fase Berbunga', 'Pemerikasaan Fase Masak', 'Pemeriksaan Alat Panen', 'Pengujian Benih', 'Sertifikasi Selesai'])->default('Proses Permohonan')->after('jumlah_benih');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sertifikasis', function (Blueprint $table) {
            //
        });
    }
};
