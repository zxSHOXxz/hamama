<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name' => 'مدير 2', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Role::create(['name' => 'مدير 1', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Role::create(['name' => 'عميل عادي', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Role::create(['name' => 'عميل متقدم', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        //PERMISSIONS - ADMIN AUTH
        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'Index-Role', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-Role', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'Index-Permission', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-Permission', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-street', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-street', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-street', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-street', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-client', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-client', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-client', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-client', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-sub-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-sub-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-sub-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-sub-city', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-captain', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-captain', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-captain', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-captain', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-order', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-order', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-order', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-order', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-bonus', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-bonus', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-bonus', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-bonus', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        // Client client
        Permission::create(['name' => 'index-admin', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-admin', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-admin', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-admin', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-street', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-street', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-street', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-street', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-client', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-client', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-client', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-client', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-sub-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-sub-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-sub-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-sub-city', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-captain', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-captain', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-captain', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-captain', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-order', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-order', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-order', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-order', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);

        Permission::create(['name' => 'index-bonus', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'create-bonus', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'update-bonus', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
        Permission::create(['name' => 'delete-bonus', 'guard_name' => 'client', 'created_at' => now(), 'updated_at' => now()]);
    }

}