<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenangkarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_users = [
            '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37'
        ];
        $nama = [
            'BBI Padi Kurik',
            'KT. Sekalindo',
            'KT. Bina Warga',
            'KT. Sumber Rejeki',
            'KT. Argo Sari',
            'BBU Padi Rawa Sari',
            'KT. Suka Maju',
            'Pramujito',
            'KT. Dwi Sri',
            'KT. Budi Mekar',
            'BBI Padi Kurik',
            'KT. Aneka Varietas',
            'KT. Sejahtera',
            'BBP Wapeko',
            'KT. Lancar IV',
            'BSIP Papua'
        ];
        $alamat = [
            'Kurik',
            'Sumber Harapan',
            'Amun kay',
            'Muram Sari',
            'Muram Sari',
            'Rawasari',
            'Bersehati',
            'Kamnosari',
            'Rawa Sari',
            'Ngguti Bob',
            'Kurik',
            'Bokem',
            'Sermayam Indah',
            'Wapeko',
            'Rimba jaya',
            'Merauke'
        ];
        $latitude = [
            '-8.2908476',
            '-8.361272',
            '-8.3206732',
            '-8.363039',
            '-8.370172',
            '-8.2953328',
            '-8.255945',
            '-8.195066',
            '-8.301048',
            '-8.293354',
            '-8.291249',
            '-8.570196',
            '-8.290834',
            '-8.165084',
            '-8.535363',
            '-8.493273'
        ];
        $longitude = [
            '140.2615597',
            '140.480497',
            '140.4972187',
            '140.367363',
            '140.384186',
            '140.2512417',
            '140.766818',
            '140.8011921',
            '140.239151',
            '140.694973',
            '140.262045',
            '140.476445',
            '140.642366',
            '140.402777',
            '140.441578',
            '140.408774'
        ];
        $jenis = [
            'Mandiri',
            'Kelompok',
            'Kelompok',
            'Kelompok',
            'Kelompok',
            'Mandiri',
            'Kelompok',
            'Mandiri',
            'Kelompok',
            'Kelompok',
            'Mandiri',
            'Kelompok',
            'Kelompok',
            'Mandiri',
            'Kelompok',
            'Mandiri'
        ];
        $anggota = [
            '1',
            '2',
            '2',
            '2',
            '2',
            '1',
            '2',
            '1',
            '2',
            '2',
            '1',
            '2',
            '2',
            '1',
            '2',
            '1'
        ];
        foreach ($id_users as $key => $id) {
            DB::table('penangkars')->insert([
                'id_user' => $id,
                'nama' => $nama[$key],
                'Alamat' => 'Kampung ' . $alamat[$key],
                'jenis' => $jenis[$key],
                'jumlah_anggota' => $anggota[$key],
                'latitude' => $latitude[$key],
                'longitude' => $longitude[$key],
                'luas_lahan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
