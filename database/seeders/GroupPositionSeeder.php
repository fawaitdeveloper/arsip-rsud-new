<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GroupPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_positions')->insert([
            'name' => 'Menteri',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('group_positions')->insert([
            'name' => 'Eselon I',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('group_positions')->insert([
            'name' => 'Eselon II',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('group_positions')->insert([
            'name' => 'Eselon III / Koordinator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('group_positions')->insert([
            'name' => 'Eselon IV / Sub-Koordinator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('group_positions')->insert([
            'name' => 'Kepala LPNK',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('group_positions')->insert([
            'name' => 'Fungsional Tertentu',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('group_positions')->insert([
            'name' => 'Fungsional Umum',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('group_positions')->insert([
            'name' => 'Staff',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
