<?php

namespace Database\Seeders;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'psp_id' => '1',
            'name' => 'Proyecto Generico 1',
            'contract_number' => '001',
            'contract_start_date' => Carbon::now(),
            'contract_end_date' => Carbon::tomorrow()
        ]);
    }
}
