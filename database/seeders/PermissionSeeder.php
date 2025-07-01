<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Staff', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Customer', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('roles')->insert($roles);

        $permissions = [
            ['menu' => 'Potential Customer','name' => 'create_potential_customer', 'label' => 'Create Potential Customer',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Potential Customer', 'name' => 'view_potential_customer','label' => 'view Potential Customer',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Potential Customer','name' => 'edit_potential_customer','label' => 'Edit Potential Customer',   'guard_name' => 'web','created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Potential Customer','name' => 'delete_potential_customer','label' => 'Delete Potential Customer',  'guard_name' => 'web',  'created_at' => now(), 'updated_at' => now()],

            ['menu' => 'Manage Customer','name' => 'create_manage_customer', 'label' => 'Create Manage Customer',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Manage Customer', 'name' => 'view_manage_customer','label' => 'view Manage Customer',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Manage Customer','name' => 'edit_manage_customer','label' => 'Edit Manage Customer',   'guard_name' => 'web','created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Manage Customer','name' => 'delete_manage_customer','label' => 'Delete Manage Customer',  'guard_name' => 'web',  'created_at' => now(), 'updated_at' => now()],

            ['menu' => 'Package','name' => 'create_package', 'label' => 'Create Package',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Package', 'name' => 'view_package','label' => 'view Package',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Package','name' => 'edit_package','label' => 'Edit Package',   'guard_name' => 'web','created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Package','name' => 'delete_package','label' => 'Delete Package',  'guard_name' => 'web',  'created_at' => now(), 'updated_at' => now()],

            ['menu' => 'Staff','name' => 'create_staff', 'label' => 'Create Staff',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Staff','name' => 'view_staff','label' => 'view Staff',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Staff','name' => 'edit_staff','label' => 'Edit Staff',   'guard_name' => 'web','created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Staff','name' => 'delete_staff','label' => 'Delete Staff',  'guard_name' => 'web',  'created_at' => now(), 'updated_at' => now()],


            ['menu' => 'Role','name' => 'create_role', 'label' => 'Create Role',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Role','name' => 'view_role','label' => 'view Role',  'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Role','name' => 'edit_role','label' => 'Edit Role',   'guard_name' => 'web','created_at' => now(), 'updated_at' => now()],
            ['menu' => 'Role','name' => 'delete_role','label' => 'Delete Role',  'guard_name' => 'web',  'created_at' => now(), 'updated_at' => now()],

        ];

        // Insert permissions into the database
        DB::table('permissions')->insert($permissions);

          // Assign all permissions to Super Admin role
    $permissionIds = DB::table('permissions')->pluck('id');
    $roleId = DB::table('roles')->where('name', 'Super Admin')->value('id');
    $rolePermissions = $permissionIds->map(function ($permissionId) use ($roleId) {
        return ['role_id' => $roleId, 'permission_id' => $permissionId];
    })->toArray();

    DB::table('role_has_permissions')->insert($rolePermissions);

    DB::table('model_has_roles')->insert([
    'role_id' => $roleId,
    'model_type' => 'App\Models\User', // Update this to match your user model namespace
    'model_id' => 1,
]);
    }
}
