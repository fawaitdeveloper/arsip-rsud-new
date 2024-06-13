<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LetterAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('letter_attributes')->insert([
            'name' => 'Biasa',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('letter_attributes')->insert([
            'name' => 'Rahasia',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('letter_attributes')->insert([
            'name' => 'Sangat Rahasia',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
