<?php

namespace Database\Seeders;

use App\Models\JobLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobLevel::create([
            'name'=>'Sekretaris'
        ]);
        JobLevel::create([
            'name'=>'Ketua'
        ]);
        JobLevel::create([
            'name'=>'Bendahara'
        ]);
        JobLevel::create([
            'name'=>'Staf'
        ]);
    }
}
