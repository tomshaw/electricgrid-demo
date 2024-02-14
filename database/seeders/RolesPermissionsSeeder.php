<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'member']);

        // create roles with guards
        // Role::create(['guard_name' => 'admin', 'name' => 'Admin']);
        // Role::create(['guard_name' => 'member', 'name' => 'Member']);

        // create permissions
        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'report']);

        // assign created permissions
        $role = Role::where('name', 'admin')->first();
        $role->givePermissionTo(Permission::all());

        // this can be done as separate statements
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo('edit articles');

        // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])->givePermissionTo(['publish articles', 'unpublish articles']);

        // $role = Role::create(['name' => 'super-admin']);
        // $role->givePermissionTo(Permission::all());
    }
}