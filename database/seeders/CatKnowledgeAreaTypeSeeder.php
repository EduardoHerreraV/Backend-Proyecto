<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatKnowledgeAreaTypeSeeder extends Seeder
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
                'name' =>'Lenguaje de programación',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'Estructura de datos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' =>'Frameworks',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
    DB::table('cat_knowledge_area_types')->insert($values);
    }
}
