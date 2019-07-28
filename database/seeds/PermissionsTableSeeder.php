<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \Spatie\Permission\Models\Role::where('name','Administrador')->get();

        $permission1 = Permission::create(['name' => 'Criar cidade']);
        $permission2 = Permission::create(['name' => 'Excluir cidade']);
        $permission3 = Permission::create(['name' => 'Editar cidade']);
        $permission4 = Permission::create(['name' => 'Visualizar cidades']);
        $permission1->syncRoles($admin);
        $permission2->syncRoles($admin);
        $permission3->syncRoles($admin);
        $permission4->syncRoles($admin);

        $permission5 = Permission::create(['name' => 'Criar estado']);
        $permission6 = Permission::create(['name' => 'Excluir estado']);
        $permission7 = Permission::create(['name' => 'Editar estado']);
        $permission8 = Permission::create(['name' => 'Visualizar estados']);
        $permission5->syncRoles($admin);
        $permission6->syncRoles($admin);
        $permission7->syncRoles($admin);
        $permission8->syncRoles($admin);

        $permission9 = Permission::create(['name' => 'Criar usuário']);
        $permission10 = Permission::create(['name' => 'Excluir usuário']);
        $permission11 = Permission::create(['name' => 'Editar usuário']);
        $permission12 = Permission::create(['name' => 'Visualizar usuários']);
        $permission13 = Permission::create(['name' => 'Gerenciar papel usuário']);
        $permission14 = Permission::create(['name' => 'Gerenciar permissões usuário']);
        $permission9->syncRoles($admin);
        $permission10->syncRoles($admin);
        $permission11->syncRoles($admin);
        $permission12->syncRoles($admin);
        $permission13->syncRoles($admin);
        $permission14->syncRoles($admin);

        $permission15 = Permission::create(['name' => 'Criar papéis']);
        $permission16 = Permission::create(['name' => 'Editar papéis']);
        $permission17 = Permission::create(['name' => 'Excluir papéis']);
        $permission18 = Permission::create(['name' => 'Visualizar papéis']);
        $permission15->syncRoles($admin);
        $permission16->syncRoles($admin);
        $permission17->syncRoles($admin);
        $permission18->syncRoles($admin);

        $permission19 = Permission::create(['name' => 'Criar permissões']);
        $permission20 = Permission::create(['name' => 'Excluir permissões']);
        $permission21 = Permission::create(['name' => 'Editar permissões']);
        $permission22 = Permission::create(['name' => 'Visualizar permissões']);
        $permission19->syncRoles($admin);
        $permission20->syncRoles($admin);
        $permission21->syncRoles($admin);
        $permission22->syncRoles($admin);

        $permission23 = Permission::create(['name' => 'Gerenciar configurações']);
        $permission23->syncRoles($admin);

        $permission24 = Permission::create(['name' => 'Criar estilos musicais']);
        $permission25 = Permission::create(['name' => 'Excluir estilos musicais']);
        $permission26 = Permission::create(['name' => 'Editar estilos musicais']);
        $permission27 = Permission::create(['name' => 'Visualizar estilos musicais']);
        $permission24->syncRoles($admin);
        $permission25->syncRoles($admin);
        $permission26->syncRoles($admin);
        $permission27->syncRoles($admin);

        $permission28 = Permission::create(['name' => 'Criar categorias']);
        $permission29 = Permission::create(['name' => 'Excluir categorias']);
        $permission30 = Permission::create(['name' => 'Editar categorias']);
        $permission31 = Permission::create(['name' => 'Visualizar categorias']);
        $permission28->syncRoles($admin);
        $permission29->syncRoles($admin);
        $permission30->syncRoles($admin);
        $permission31->syncRoles($admin);

        $permission32 = Permission::create(['name' => 'Criar anúncios']);
        $permission33 = Permission::create(['name' => 'Excluir anúncios']);
        $permission34 = Permission::create(['name' => 'Editar anúncios']);
        $permission35 = Permission::create(['name' => 'Visualizar anúncios']);
        $permission32->syncRoles($admin);
        $permission33->syncRoles($admin);
        $permission34->syncRoles($admin);
        $permission35->syncRoles($admin);
    }
}
