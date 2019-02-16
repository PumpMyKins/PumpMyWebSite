<?php

use Illuminate\Database\Seeder;
use App\Candidature;

class CandidatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*$i = 0;
        while($i <= 100)
        {
        	$i++*/
        	Candidature::create([
	    		'type' => 'staff',
	    		'pseudo' => str_random(10),
	    		'slug' => str_random(15),
	    		'prenom' => str_random(10),
	    		'age' => random_int(0, 100),
	    		'horaire' => str_random(200),
	    		'motivation' => str_random(200),
	    		'anciennete' => str_random(200),
	    		'presentation' => str_random(400),
	    		'sanction' => str_random(200),
	    		'user_id' => random_int(1, 100),
                'upvote' => 'null',
                'downvote' => 'nuleel',
	    	]);
        //}
    }
}
