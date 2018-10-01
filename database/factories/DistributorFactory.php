<?php

use Faker\Generator as Faker;

$factory->define(App\Distributor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => $faker->imageUrl('100', '100'),
        'location' => json_encode([
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'address' => $faker->address,
        ]),
        'account_id' => random_int(1, 100),
    ];
});
