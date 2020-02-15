<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Carbon\Carbon;
 
$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle(50),
        'body' => $faker->address(100),
        'published_at' => Carbon::today(),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});