<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'user_id' => 1,
            'name' => 'Nombre de Tarea Generica',
            'description' => 'Descripcion de tarea generica',
            'sprint' => 1,
            'dependencies' => 'INFOTEC',
            'hours' => 10,
            'project_id' => 1,
            'cat_size_id' => 1,
            'cat_phase_id' => 1,
            'cat_statuses_id' => 1
        ]);

        Task::create([
            'user_id' => 1,
            'name' => 'Nombre de Tarea Generica',
            'description' => 'Descripcion de tarea generica',
            'sprint' => 1,
            'dependencies' => 'INFOTEC',
            'hours' => 10,
            'project_id' => 1,
            'cat_size_id' => 1,
            'cat_phase_id' => 1,
            'cat_statuses_id' => 1
        ]);

        Task::create([
            'user_id' => 1,
            'name' => 'Nombre de Tarea Generica',
            'description' => 'Descripcion de tarea generica',
            'sprint' => 1,
            'dependencies' => 'INFOTEC',
            'hours' => 10,
            'project_id' => 1,
            'cat_size_id' => 1,
            'cat_phase_id' => 1,
            'cat_statuses_id' => 1
        ]);

        Task::create([
            'user_id' => 1,
            'name' => 'Nombre de Tarea Generica',
            'description' => 'Descripcion de tarea generica',
            'sprint' => 1,
            'dependencies' => 'INFOTEC',
            'hours' => 10,
            'project_id' => 1,
            'cat_size_id' => 1,
            'cat_phase_id' => 1,
            'cat_statuses_id' => 1
        ]);

        Task::create([
            'user_id' => 1,
            'name' => 'Nombre de Tarea Generica',
            'description' => 'Descripcion de tarea generica',
            'sprint' => 1,
            'dependencies' => 'INFOTEC',
            'hours' => 10,
            'project_id' => 1,
            'cat_size_id' => 1,
            'cat_phase_id' => 1,
            'cat_statuses_id' => 1
        ]);

        Task::create([
            'user_id' => 1,
            'name' => 'Nombre de Tarea Generica',
            'description' => 'Descripcion de tarea generica',
            'sprint' => 1,
            'dependencies' => 'INFOTEC',
            'hours' => 10,
            'project_id' => 1,
            'cat_size_id' => 1,
            'cat_phase_id' => 1,
            'cat_statuses_id' => 2,
            'employee_id' => 1,
            'start_date' => Carbon::now()
        ]);
    }
}
