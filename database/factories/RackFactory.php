<?php

use Faker\Generator as Faker;

$factory->define(App\Rack::class, function (Faker $faker) {
    return [
        "name"=>$faker->realText(25)
    ];
});
