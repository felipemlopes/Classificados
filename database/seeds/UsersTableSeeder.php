<?php

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
        $user->id_estado = 1;
        $user->id_cidade = 1;
        $user->save();

        $user->assignRole('Administrador');


    }
}
