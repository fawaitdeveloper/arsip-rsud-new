<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nip' => '123456',
            'nik' => '789012',
            'name' => 'Admin RSUD Wonogiri',
            'username' => 'admin.rsud.wonogiri',
            'photo' => 0, // Ini sesuai dengan nilai default yang Anda tentukan
            'email' => 'admin@example.com',
            'phone_number' => '123456789',
            'isActive' => true, // Aktif
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
