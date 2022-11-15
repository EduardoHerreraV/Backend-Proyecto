<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modules;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modules::create([
            'id'       => 1,
            'name'     =>'Modulo super Admin',
            'key'     =>'module_admin'
        ]);
        Modules::create([
            'id'       => 2,
            'name'     =>'Modulo alumno',
            'key'     =>'module_alumno'
        ]);
        Modules::create([
            'id'       => 3,
            'name'     =>'Modulo profesor',
            'key'     => 'module_profesor'
        ]);

    }

}
