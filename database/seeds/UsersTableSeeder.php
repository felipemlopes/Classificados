<?php

use App\Models\Plan;
use App\Models\PlanSubscription;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user= new \App\Models\User();
        $user->first_name = 'Admin';
        $user->last_name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = 'admin123';
        $user->save();

        $user->assignRole('Administrador');

    }
}
