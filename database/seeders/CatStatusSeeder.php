<?php

namespace Database\Seeders;

use App\Models\CatStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CatStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatStatus::create([
            'name' => 'Creada'
        ]);
        CatStatus::create([
            'name' => 'Asignada'
        ]);
        CatStatus::create([
            'name' => 'En proceso'
        ]);
        CatStatus::create([
            'name' => 'En pausa'
        ]);
        CatStatus::create([
            'name' => 'Terminada'
        ]);
        CatStatus::create([
            'name' => 'Validada'
        ]);
        CatStatus::create([
            'name' => 'Cancelada'
        ]);
    }
}
