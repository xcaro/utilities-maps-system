<?php

use Faker\Generator as Faker;

$factory->define(App\Report::class, function (Faker $faker) {
	$dst = \App\District::inRandomOrder()->first()->id;
    return [
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,

        'comment' => $faker->streetAddress,
        'type_id' => rand(1, 4),
        'user_created' => 1,
        'created_at' => $faker->dateTimeThisYear(),
        'district_id' => $dst,
        'ward_id' => \App\Ward::where('district_id', 1)->inRandomOrder()->first()->id,
    ];
});
