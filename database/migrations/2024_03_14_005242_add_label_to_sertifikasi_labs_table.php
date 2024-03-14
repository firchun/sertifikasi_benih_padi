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
        Schema::table('sertifikasi_labs', function (Blueprint $table) {
            $table->enum('label', ['Putih', 'Kuning', 'Ungu', 'Biru'])->default('Biru')->after('kesehatan_benih');
            $table->enum('kesimpulan', ['Lulus', 'Tidak'])->default('Tidak')->after('label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sertifikasi_labs', function (Blueprint $table) {
            //
        });
    }
};
