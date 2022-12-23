<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name' => 'عمرووو الخزندار',
            'mobile' => '0598241105',
            'gender' => 'male',
            'actor_type' => 'App\Models\Admin',
            'actor_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin = Admin::create([
            'email' => 'adminseeder@hamama.ps',
            'password' => '$2y$10$pVTX9gKr1Bwk9KOO7YK26OrY.CfUNVkTWk6fcSQWohHzB5H2T7icW',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin->assignRole(['مدير 1']);
        $role = Role::findOrFail(2);
        $permissions = Permission::where('guard_name', 'admin')->get();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission->id);
        }
    }
}