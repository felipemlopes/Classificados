<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Plan::create([
            'name' => 'Free',
            'price' => 0,
        ]);

        \App\Models\Plan::create([
            'name' => 'Premium',
            'price' => 10,
        ]);
    }
}
