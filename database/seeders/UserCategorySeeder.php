<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_categories')->insert([
            'name' => 'TNI',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_categories')->insert([
            'name' => 'Aparatur Sipil Negara',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_categories')->insert([
            'name' => 'PNS',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_categories')->insert([
            'name' => 'Pekerja Harian Lepas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('user_categories')->insert([
            'name' => 'PPPK',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('user_categories')->insert([
            'name' => 'PPNPN',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('user_categories')->insert([
            'name' => 'Tenaga Harian Lepas',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('user_categories')->insert([
            'name' => 'Tenaga Kontrak',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
