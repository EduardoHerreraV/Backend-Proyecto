<?php

namespace Database\Seeders;

use App\Models\CatSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CatSize::create([
            'name' => 'Chico'
        ]);

        CatSize::create([
            'name' => 'Mediano'
        ]);

        CatSize::create([
            'name' => 'Grande'
        ]);
    }
}
