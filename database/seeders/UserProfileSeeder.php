<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserProfile::create([
            'id'     => 1,
            'key'    => 'super_admin',
            'name'   => 'Super Admin',
        ]);
        UserProfile::create([
            'id'     => 2,
            'key'    => 'alumno',
            'name'   => 'Alumno',
        ]);
        UserProfile::create([
            'id'     => 3,
            'key'    => 'profesor',
            'name'   => 'Profesor',
        ]);
        \DB::statement('ALTER SEQUENCE user_profiles_id_seq RESTART WITH 5');
    }
}
