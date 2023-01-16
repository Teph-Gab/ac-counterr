<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);

        Permission::create(['name' => 'edit counter']);
        Permission::create(['name' => 'delete counter']);
        Permission::create(['name' => 'create counter']);
        Permission::create(['name' => 'update counter']);

        // create roles and assign created permissions
        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('create user');
        $admin->givePermissionTo('edit user');
        $admin->givePermissionTo('update user');
        $admin->givePermissionTo('delete user');

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('create counter');
        $user->givePermissionTo('edit counter');
        $user->givePermissionTo('update counter');
        $user->givePermissionTo('delete counter');       
    }
}