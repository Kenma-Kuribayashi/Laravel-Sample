<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Eloquent\ArticleTag::class, function (Faker $faker) {
  return [
    'article_id' => function () {
      return factory(App\Article::class)->create()->id;
    },
    'tag_id' => rand([1, 9]),
    'created_at' => now(),
    'updated_at' => now(),
  ];
});
