<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'id'                => 1,
                    'username'          =>'Eduardo',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'eduardo.herrera@gmail.com',
                    'name'              => 'Eduardo',
                    'last_name'         => 'Herrera',
                    'second_last_name'   => 'Valencia',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 2,
                    'username'          =>'Aldair',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'aldair.macedo@infotec.mx',
                    'name'              => 'Aldair',
                    'last_name'         => 'Macedo',
                    'second_last_name'   => 'López',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 3,
                    'username'          =>'Marcos',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'marcos.piñeiro@infotec.mx',
                    'name'              => 'Marcos',
                    'last_name'         => 'Piñeiro',
                    'second_last_name'   => 'Villegas',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 4,
                    'username'          =>'Adrian',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'adrian.rodriguez@infotec.mx',
                    'name'              => 'Adrian',
                    'last_name'         => 'Rodriguez',
                    'second_last_name'   => 'Montes',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
           ]
        );
        DB::statement('ALTER SEQUENCE public.users_id_seq RESTART WITH 6');
    }
}
