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
                    'name'              => 'Eduardo Herrera Valencia',
                    'profile'           => 'super_admin',
                    'username'          =>'Eduardo',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'eduardo.herrera@gmail.com',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 2,
                    'name'              => 'Aldair Macedo Lopez',
                    'profile'           => 'super_admin',
                    'username'          =>'Aldair',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'aldair.macedo@infotec.mx',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 3,
                    'name'              => 'Marcos Piñeiro Villegas',
                    'profile'           => 'super_admin',
                    'username'          =>'Marcos',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'marcos.piñeiro@infotec.mx',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 4,
                    'name'              => 'Adrian Rodriguez Montes',
                    'profile'           => 'super_admin',
                    'username'          =>'Adrian',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'adrian.rodriguez@infotec.mx',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
           ]
        );
        DB::statement('ALTER SEQUENCE public.users_id_seq RESTART WITH 6');
    }
}
