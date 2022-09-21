<?php

namespace Database\Seeders;

use App\Models\CatStatusCause;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatStatusCauseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CatStatusCause::create([
            'cat_status_id' => 3,
            'name' => 'Causa de estatus',
            'description' => 'Porque fue causado el estatus'
        ]);
    }
}
