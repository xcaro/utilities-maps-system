<?php

use Faker\Generator as Faker;

$factory->define(App\Report::class, function (Faker $faker) {
    return [
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'comment' => $faker->streetAddress,
        'type_id' => rand(1, 4),
        'user_created' => 1,
    ];
});
