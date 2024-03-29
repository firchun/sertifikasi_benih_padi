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
        Schema::create('Penangkars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('nama');
            $table->text('alamat');
            $table->enum('jenis', ['Mandiri', 'Kelompok']);
            $table->integer('jumlah_anggota')->default(1);
            $table->float('total_luas_lahan');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('Penangkars');
    }
};
