<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'type_id' => random_int(1, 10),
        'user_id' => random_int(1, 5),
    ];
});
