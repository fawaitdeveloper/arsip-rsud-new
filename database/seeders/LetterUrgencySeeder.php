<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LetterUrgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('letter_urgencies')->insert([
            'name' => 'Biasa',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('letter_urgencies')->insert([
            'name' => 'Segera',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('letter_urgencies')->insert([
            'name' => 'Amat Segera',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
