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
            )
        );

        foreach ($roles as $role) {
            $newRole = Role::create(['name' => $role['name']]);

            foreach ($role['permissions'] as $permission) {
                $newRole->givePermissionTo($permission);
            }
        }
    }
}