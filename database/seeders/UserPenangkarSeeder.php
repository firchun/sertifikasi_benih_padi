<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserPenangkarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Fiktor Rumaseb S.ST',
            'email' => 'user1@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Adha Lusi',
            'email' => 'user2@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Margono',
            'email' => 'user3@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Bambang Priyono',
            'email' => 'user4@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Amrin Lima',
            'email' => 'user5@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Hadi Sulistio',
            'email' => 'user6@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Pramujito',
            'email' => 'user7@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Rajimun',
            'email' => 'user8@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Aceng Sumarlin',
            'email' => 'user9@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jono',
            'email' => 'user10@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Simon Wollo',
            'email' => 'user11@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'M. Kasmidi',
            'email' => 'user12@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Arik S. Parnomo',
            'email' => 'user13@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Nur Habib',
            'email' => 'user14@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Sukarno',
            'email' => 'user15@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Franciscus Palobo M.Si',
            'email' => 'user16@gmail.com',
            'id_desa' => 1,
            'role' => 'Penangkar',
            'password' => Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
