<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        "title" => $faker->text(50),
        "author"=> $faker->name,
        "published_year" => $faker->year
    ];
});
