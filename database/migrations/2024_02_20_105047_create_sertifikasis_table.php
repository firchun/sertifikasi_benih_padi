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
        Schema::create('sertifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('komoditas')->default('Padi');
            //identitas pemohon
            $table->string('nama_pemohon');
            $table->string('alamat');
            //sertifikasi benih untuk..
            $table->float('luas_pertanaman');
            $table->foreignId('id_varietas');
            $table->date('tanggal_sebar');
            $table->date('tanggal_tanam');
            //letak tanah
            $table->string('blok');
            $table->foreignId('id_desa');
            $table->foreignId('id_kecamatan');
            $table->string('kabupaten')->default('Merauke');
            //tanaman sebelumnya
            $table->string('jenis_tanaman_sebelumnya')->default('Padi');
            $table->date('tanggal_panen_sebelumnya')->nullable();
            $table->string('pemeriksaan_lapangan_sebelumnya')->nullable();
            $table->foreignId('id_varietas_sebelumnya');
            $table->foreignId('id_kelas_benih_sebelumnya');
            $table->enum('disertifikasi_sebelumnya', ['Ya', 'Tidak'])->default('Tidak');
            //asal benih
            $table->string('produsen_asal');
            $table->string('benih_asal');
            $table->foreignId('id_kelas_benih_asal');
            $table->string('no_kelompok_benih')->default(0);
            $table->float('jumlah_benih')->default(0);
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
        Schema::dropIfExists('sertifikasis');
    }
};
