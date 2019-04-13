<?php

use App\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    return [
        'note_identifier' => $faker->unique()->numerify('############################################'),
        'total_value' => $faker->numberBetween(4300,270000),
        'cpf' => rand(0,30) === 0 ? cpf($faker->randomNumber(9)) : null,
    ];
});
