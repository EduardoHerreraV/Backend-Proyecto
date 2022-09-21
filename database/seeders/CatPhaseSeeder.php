<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CatPhaseSeeder extends Seeder
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
                'name' =>'Análisis',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'Codificación',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'Otros',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
    DB::table('cat_phases')->insert($values);
    }
}
