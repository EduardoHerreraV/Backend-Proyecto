<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionSeeder extends Seeder
{
    /**role_has_permissions
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $SUPER_ADMIN_PROFILE_ID = 1;
        $permissions = \DB::table('profiles')->get();
        foreach($permissions as $permission) {
            array_push($data, ['profile_id' => $SUPER_ADMIN_PROFILE_ID, 'permission_id'=> $permission->id]);
        }
        \DB::table('role_has_permissions')->insert($data);



    }
}
