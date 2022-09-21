<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Kitsia Liliana',
            'last_name' => 'Acosta',
            'second_last_name' => 'Camacho',
            'rfc' =>  'AOCK980228KH1',
            'curp' => '',
            'gender' => 'femenine',
        ]);

        Employee::create([
            'name' => 'Eduardo Hiram',
            'last_name' => 'Rubio',
            'second_last_name' => 'Flores',
            'rfc' =>  'RUFE001226PG6',
            'curp' => 'RUFE001226HASBLDA3',
            'gender' => 'masculine',
        ]);
    }
}
