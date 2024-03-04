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
        Schema::create('stok_benihs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreignId('id_penangkar');
            $table->foreignId('id_sertifikasi');
            $table->enum('jenis_stok', ['tambah', 'kurang']);
            $table->float('jumlah_stok')->default(0);
            $table->timestamps();

            $table->foreign('id_sertifikasi')->references('id')->on('sertifikasis');
            $table->foreign('id_penangkar')->references('id')->on('penangkars');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_benihs');
    }
};
