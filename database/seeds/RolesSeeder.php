<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array roles
        $roles = array(
            array(
                'name' => 'Administrator',
                'permissions' => Permission::all()->pluck('id')
            ),
            array(
                'name' => 'User',
                'permissions' => array()
            )
        );

        foreach ($roles as $role) {
            $newRole = Role::create(['name' => $role['name']]);

            if (count($role['permissions']) > 0) {
                foreach ($role['permissions'] as $permission) {
                    $newRole->givePermissionTo($permission);
                }
            }
        }
    }
}