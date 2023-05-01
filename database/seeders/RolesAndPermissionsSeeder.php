<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $chefRole = Role::create(['name' => 'chef']);
        $adminRole = Role::create(['name' => 'admin']);
        $agentRole = Role::create(['name' => 'agent']);

        // Create permissions

            //demande
        $viewDemandesPermission = Permission::create(['name' => 'view-demands']);
        $createDemandePermission = Permission::create(['name' => 'create-demande']);
        $editDemandePermission = Permission::create(['name' => 'edit-demande']);
        $deleteDemandePermission = Permission::create(['name' => 'delete-demande']);

            //users
        $viewUsersPermission = Permission::create(['name' => 'view-users']);
        $createUserPermission = Permission::create(['name' => 'create-user']);
        $editUserPermission = Permission::create(['name' => 'edit-user']);
        $deleteUserPermission = Permission::create(['name' => 'delete-user']);

            //formation
        $viewFormationPermission = Permission::create(['name' => 'view-formation']);
        $createFormationPermission = Permission::create(['name' => 'create-formation']);
        $editFormationPermission = Permission::create(['name' => 'edit-formation']);
        $deleteFormationPermission = Permission::create(['name' => 'delete-formation']);

        // Assign permissions to roles
        $adminRole->syncPermissions([
            $viewUsersPermission,
            $createUserPermission,
            $editUserPermission,
            $deleteUserPermission
        ]);

        $agentRole->syncPermissions([
            $viewDemandesPermission,
            $createDemandePermission,
            $editDemandePermission,
            $deleteDemandePermission,

            $viewFormationPermission,
            $createFormationPermission,
            $editFormationPermission,
            $deleteFormationPermission,
        ]);

        $chefRole->syncPermissions([
            $viewDemandesPermission,
            $createDemandePermission,
            $editDemandePermission,
            $deleteDemandePermission,

            $viewUsersPermission,
            $createUserPermission,
            $editUserPermission,
            $deleteUserPermission,

            $viewFormationPermission,
            $createFormationPermission,
            $editFormationPermission,
            $deleteFormationPermission,
        ]);

    }
}
