<?php

namespace Database\Seeders;

use App\Models\Initiative;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InitiativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Initiative::create([
            'project_id'=> '1',
            'name' => 'Nombre Iniciativa'
        ]);
    }
}
