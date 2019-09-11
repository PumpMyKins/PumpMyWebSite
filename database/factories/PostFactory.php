<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

	$factory->define(Post::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [

    	'type' => 'general',
    	'title' => $faker->sentence(20),
    	'content' => $faker->text(10000),
    	'user_id' => $faker->randomElement($users),

    ];
});
