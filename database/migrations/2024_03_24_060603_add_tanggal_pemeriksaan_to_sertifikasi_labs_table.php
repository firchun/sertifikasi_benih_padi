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
            $table->date('tanggal_pemeriksaan')->nullable()->after('tanggal_panen');
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
