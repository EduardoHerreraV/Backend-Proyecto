<?php

namespace Database\Seeders;

use App\Models\CatSize;
use App\Models\CatStatusCause;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CatStatusSeeder::class,
            CatSizeSeeder::class,
            CatPhaseSeeder::class,
            CatKnowledgeAreaTypeSeeder::class,
            CatSpecificKnowledgeSeeder::class,
            CatStatusCauseSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            ProjectSeeder::class,
            TaskSeeder::class,
            InitiativeSeeder::class,
        ]);
    }
}
