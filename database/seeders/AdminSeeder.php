<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'nama' => 'Super Administrator',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'alamat' => 'Jalan A No. 1',
            'tempat_lahir' => 'Aceh',
            'tanggal_lahir' => "1981-05-15",
            'jabatan' => 'admin'
        ]);
    }
}
