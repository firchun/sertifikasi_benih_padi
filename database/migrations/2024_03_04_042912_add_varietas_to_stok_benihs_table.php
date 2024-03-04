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
        Schema::table('stok_benihs', function (Blueprint $table) {
            $table->foreignId('id_varietas')->after('id_user');
            $table->foreignId('id_kelas_benih')->after('id_varietas');

            $table->foreign('id_varietas')->references('id')->on('varietas');
            $table->foreign('id_kelas_benih')->references('id')->on('kelas_benihs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stok_benihs', function (Blueprint $table) {
            //
        });
    }
};
