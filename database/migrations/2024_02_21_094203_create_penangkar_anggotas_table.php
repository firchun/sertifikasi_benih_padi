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
        Schema::create('penangkar_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penangkar');
            $table->string('nama_anggota');
            $table->float('luas_lahan')->default(0);
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
        Schema::dropIfExists('penangkar_anggotas');
    }
};
