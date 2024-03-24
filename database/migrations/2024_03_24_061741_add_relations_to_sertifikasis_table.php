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
            $table->foreign('id_varietas')->references('id')->on('varietas');
            $table->foreign('id_desa')->references('id')->on('desas');
            $table->foreign('id_kecamatan')->references('id')->on('kecamatans');
            $table->foreign('id_varietas_sebelumnya')->references('id')->on('varietas');
            $table->foreign('id_kelas_benih_sebelumnya')->references('id')->on('kelas_benihs');
            $table->foreign('id_kelas_benih_asal')->references('id')->on('kelas_benihs');
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
