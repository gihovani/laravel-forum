<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => implode(' ',$faker->paragraphs),
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
