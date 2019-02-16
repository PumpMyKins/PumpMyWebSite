<?php

use Faker\Generator as Faker;

$factory->define(App\Server::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'short_description' => str_random(230),
        'ip' => str_random(25),
        'image' => $faker->image('public/images/server', 400, 300, null, false),
        'description' => str_random(8000),
        'open_date' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'slug' => str_random(10),
        'close' => '0',
    ];
});
