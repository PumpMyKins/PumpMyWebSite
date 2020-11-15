<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    private array $roles;
    private array $permissions;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roles['admin'] = Role::create(['name' => 'Administration']);
        $this->roles['modo'] = Role::create(['name' => 'Moderation']);
        $this->roles['player'] = Role::create(['name' => 'Joueur']);
    }
}
