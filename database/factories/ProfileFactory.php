<?php

use App\Profile;
use App\User;

use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'username' => $faker->unique()->userName,
        'title' => $faker->sentence,
        'gender_id' => $faker->randomElement([1,2,3]),
        'summary' => $faker->paragraph,
        'description' => $faker->paragraph,
        'location' => function() {
            $m = 10000000;

            $long = mt_rand((26.6061069 * $m), (28.1002165 * $m)) / $m;
            $lat = mt_rand((152.9340738 * $m), (153.4144958 * $m)) / $m;

            return sprintf('-%F,%F', $long, $lat);
        }
    ];
});
