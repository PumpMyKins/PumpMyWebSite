<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Staff Permission
        Permission::create(['name' => 'manage forum']);
        Permission::create(['name' => 'manage server']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage roles']);

        //Forum Permission
        Permission::create(['name' => 'warn']);
        Permission::create(['name' => 'ban']);

        // Registrered User Permission
        Permission::create(['name' => 'post forum']);

        // Role and Default Permission Set
        Role::create(['name' => 'fondateur'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Responsable'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Administrateur'])->givePermissionTo(['manage forum','warn','ban','post forum']);
		Role::create(['name' => 'Moderateur'])->givePermissionTo(['manage forum','warn','post forum']);
        Role::create(['name' => 'Helpeur'])->givePermissionTo(['manage forum','post forum']);
        Role::create(['name' => 'Joueur'])->givePermissionTo(['post forum']);
        Role::create(['name' => 'Banni']);
        
    }
}
