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
        Schema::create('harga_kelas_benihs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelas_benih');
            $table->integer('harga');
            $table->timestamps();

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
        Schema::dropIfExists('harga_kelas_benihs');
    }
};
