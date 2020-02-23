<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Carbon\Carbon;
 
$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(30),
        'body' => $faker->realText(70),
        'published_at' => Carbon::today(),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});