<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fondateur = Role::create(['name' => 'fondateur']);
        $responsable = Role::create(['name' => 'responsable']);
        $administrateur = Role::create(['name' => 'administrateur']);
        $moderateur = Role::create(['name' => 'moderateur']);
        $joueur = Role::create(['name' => 'joueur']);
    }
}
