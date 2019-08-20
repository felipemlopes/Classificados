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
        $user->first_name = 'Felipe';
        $user->last_name = 'Lopes';
        $user->email = 'felipe@dev.com';
        $user->password = 'admin123';
        $user->save();

        $user->assignRole('Administrador');

        /*$plan = Plan::find(1);
        $subscription = $user->subscriptions()->save(new PlanSubscription([
            'plan_id' => $plan->id,
            'starts_on' => Carbon::now()->subSeconds(1),
            'expires_on' => Carbon::now()->addDays(100),
            'cancelled_on' => null,
            'is_paid' => (bool) true,
            'is_recurring' => true,
        ]));*/
    }
}
