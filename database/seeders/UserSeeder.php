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
                    'username'          =>'marcosp',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'mpineirov1@gmail.com',
                    'name'              => 'Marcos',
                    'last_name'         => 'Pineiro',
                    'second_last_name'   => 'Villegas',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 2,
                    'username'          =>'cristian.banos',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'cristian.banos@infotec.mx',
                    'name'              => 'Cristian',
                    'last_name'         => 'Baños',
                    'second_last_name'   => 'Padrinini',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 3,
                    'username'          =>'brandon.perez',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'brandon.perez@infotec.mx',
                    'name'              => 'Brandon',
                    'last_name'         => 'Perez',
                    'second_last_name'   => 'Ramírez',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 4,
                    'username'          =>'luis',
                    'password'          => Hash::make('12345678'),
                    'email'             =>'luis.perez@infotec.mx',
                    'name'              => 'Luis',
                    'last_name'         => 'Tierrafria',
                    'second_last_name'   => '',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ],
                [
                    'id'                => 5,
                    'username'          =>'jorge.alberto',
                    'password'          => Hash::make('87654321'),
                    'email'             =>'jorealberto@gmail.com',
                    'name'              => 'Jorge',
                    'last_name'         => 'Alberto',
                    'second_last_name'   => '',
                    'is_active'         => true,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                ]
           ]
        );
        DB::statement('ALTER SEQUENCE public.users_id_seq RESTART WITH 6');
    }
}
