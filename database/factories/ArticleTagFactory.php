<?php

use App\Eloquent\Article;
use App\Eloquent\ArticleTag;

/* @var $factory \Illuminate\Database\Eloquent\Factory */

$factory->define(ArticleTag::class, function () {
  return [
    'article_id' => function () {
      return factory(Article::class)->create()->id;
    },
    'tag_id' => rand(1, 9),
    'created_at' => now(),
    'updated_at' => now(),
  ];
});
