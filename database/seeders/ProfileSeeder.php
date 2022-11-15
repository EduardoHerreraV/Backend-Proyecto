<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            //===================== super admin (admin) ==========================
            ['key' =>'admin-view', 'name' => 'Ver Super Admin', 'description' => 'Acceso a administrador de modulos y catalogos', 'modules_id' => '1'],

            //===================== alumno ==========================
            ['key' =>'alumno-view', 'name' => 'Ver Perfil alumno', 'description' => 'Acceso a calificaciones', 'modules_id' => '2'],

            //===================== profesor ==========================
            ['key' =>'profesor-view', 'name' => 'Ver Perfil profesor', 'description' => 'Acceso a modulo de profesores', 'modules_id' => '3'],

        ]);

    }
}
