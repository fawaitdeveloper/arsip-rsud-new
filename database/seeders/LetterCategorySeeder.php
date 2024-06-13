<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LetterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('letter_categories')->insert([
            'name' => 'Nota Dinas',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('letter_categories')->insert([
            'name' => 'Naskah Dinas Biasa',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('letter_categories')->insert([
            'name' => 'Naskah Dinas Khusus',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
