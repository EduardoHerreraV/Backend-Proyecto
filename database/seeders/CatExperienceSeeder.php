<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'name' =>'Jr',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'Middle',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'Sr',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
    DB::table('cat_experiences')->insert($values);
    }
}
