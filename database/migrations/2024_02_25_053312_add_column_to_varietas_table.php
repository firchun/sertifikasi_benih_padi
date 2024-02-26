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
        Schema::table('varietas', function (Blueprint $table) {
            $table->integer('umur')->nullable()->after('description');
            $table->float('potensi_hasil')->nullable()->after('umur');
            $table->text('ketahanan_hama')->nullable()->after('potensi_hasil');
            $table->text('ketahanan_penyakit')->nullable()->after('ketahanan_hama');
            $table->text('ketahanan_abiotik')->nullable()->after('ketahanan_penyakit');
            $table->text('anjuran_tanam')->nullable()->after('ketahanan_abiotik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('varietas', function (Blueprint $table) {
            //
        });
    }
};
