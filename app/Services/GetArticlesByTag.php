<?php

namespace App\Services;

use App\Article;
use App\Tag;

class GetArticlesByTag {

  public function get_articles_by_tag(string $tag_name) {

    return Tag::where('name', $tag_name)
      ->with(['articles' => function ($query) {
        $query->latest('published_at')
        ->latest('created_at')
        ->published()
        ->paginate(10);
      }])->get();

      
  }

}

 ?>