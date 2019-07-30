<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Administrador']);

        $role = Role::create(['name' => 'Gerente']);

        $role = Role::create(['name' => 'Proprietário']);
    }
}
