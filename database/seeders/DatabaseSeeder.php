<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(GroupPositionSeeder::class);
        // $this->call(UserCategorySeeder::class);
        // $this->call(LetterAttributeSeeder::class);
        // $this->call(LetterCategorySeeder::class);
        // $this->call(LetterUrgencySeeder::class);

        $this->call(JobLevelSeeder::class);
        $this->call(PositionSeeder::class);

    }
}
