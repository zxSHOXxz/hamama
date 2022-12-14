<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'عمرو الخزندار',
            'mobile' => '0598241105',
            'gender' => 'male',
            'actor_type' => 'App\Models\Admin',
            'actor_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin = Admin::create([
            'email' => 'admin@hamama.ps',
            'password' => '$2y$10$pVTX9gKr1Bwk9KOO7YK26OrY.CfUNVkTWk6fcSQWohHzB5H2T7icW',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin->assignRole(['مدير 1']);
    }
}