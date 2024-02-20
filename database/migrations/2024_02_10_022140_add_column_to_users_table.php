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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_desa')->after('id');
            $table->string('alamat')->after('avatar')->default('-');
            $table->string('tempat_lahir')->after('alamat')->default('-');
            $table->date('tanggal_lahir')->after('tempat_lahir')->nullable();
            $table->string('no_hp')->after('tanggal_lahir')->nullable();
            $table->string('nik')->after('no_hp')->nullable();

            $table->foreign('id_desa')->references('id')->on('desas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
