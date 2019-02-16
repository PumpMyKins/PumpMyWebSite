<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$ban = Role::create([
    		'name' => 'Bannis',
    		'slug' => 'bannis',
    		'permissions' => [
    			'banned' => true,
    		]
    	]);
    	$mute = Role::create([
    		'name' => 'Mute',
    		'slug' => 'mute',
    		'permissions' => [
    			'can_candidature' => false,
    			'propose_news' => false,
    		]

    	]);
    	$joueur = Role::create([
    		'name' => 'Joueur',
    		'slug' => 'joueur',
    		'permissions' => [
    			'propose_news' => true,
    			'can_candidature' => true,
    		]
    	]);
    	$vip = Role::create([
    		'name' => 'Vip',
    		'slug' => 'vip',
    		'permissions' => [
    			'propose_news' => true,
    			'can_candidature' => true,
    		]
    	]);
    	$vipplus = Role::create([
    		'name' => 'Vip+',
    		'slug' => 'vipplus',
    		'permissions' => [
    			'propose_news' => true,
    			'can_candidature' => true,
    		]
    	]);
        $moderateur = Role::create([
        	'name' => 'Modérateur',
        	'slug' => 'modo',
        	'permissions' => [
        		'can_mute' => true,
                'staff' => true,
        	
        	]
        ]);
        $administrateur = Role::create([
        	'name' => 'Administrateur',
        	'slug' => 'admin',
        	'permissions' => [
        		'can_manage_news' => true,
        		'can_ban' => true,
        		'can_mute' => true,
                'propose_news' => true,
                'staff' => true,


        	]
        ]);
        $responsable = Role::create([
        	'name' => 'Responsable Staff',
        	'slug' => 'resp',
        	'permissions' => [
        		'can_promote' => true,
        		'can_demote' => true,
        		'can_manage_news' => true,
        		'can_ban' => true,
        		'can_mute' => true,
                'propose_news' => true,
                'staff' => true,
                'modify-profile' => true,
                'delete-profile' => true,
        	]
        ]);
        $fondateur = Role::create([
        	'name' => 'Fondateur',
        	'slug' => 'fonda',
        	'permissions' => [
        		'can_promote' => true,
        		'can_demote' => true,
        		'can_manage_news' => true,
        		'can_ban' => true,
        		'can_mute' => true,
        		'universal_protection' => true,
                'propose_news' => true,
                'staff' => true,
                'modify-profile' => true,
                'delete-profile' => true,
        	]
        ]);
    }
}
