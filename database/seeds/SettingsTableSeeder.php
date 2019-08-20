<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'forgot_password', 'value' => 1]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'reg_enabled', 'value' => 1]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'tos', 'value' => 1]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'app_name', 'value' => 'Contrata Banda']
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'home_url', 'value' => 'http://exemplo.com.br']
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'qtd_ads_artist_freeaccount', 'value' => 1]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'qtd_ads_pro_freeaccount', 'value' => 3]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'qtd_ads_destaque', 'value' => 4]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'days_ads_free', 'value' => 30]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'days_ads_premium', 'value' => 30]
        );

        \Illuminate\Support\Facades\DB::table('settings')->insert(
            ['key' => 'price_ads_premium', 'value' => '10,00']
        );

    }
}
