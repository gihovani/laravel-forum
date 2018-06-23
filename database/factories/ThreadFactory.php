<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => implode(' ',$faker->paragraphs),
        'fixed' => 0,
        'closed' => 0,
        'replies_count' => 0,
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
