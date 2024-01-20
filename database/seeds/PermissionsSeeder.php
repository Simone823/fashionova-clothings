<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = array(
            'admin_tool',
            'users_view',
            'users_create',
            'users_edit',
            'users_delete',
            'roles_view',
            'roles_create',
            'roles_edit',
            'roles_delete',
            'permissions_view',
            'permissions_create',
            'permissions_edit',
            'permissions_delete'
        );

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}