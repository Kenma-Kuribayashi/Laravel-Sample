<?php

namespace App\Services;

use App\Article;
use Illuminate\Pagination\LengthAwarePaginator;

class GetArticlesByTag {

  public function get_articles_by_tag(int $tag_id): LengthAwarePaginator {

     return Article::join('article_tag', 'article_tag.article_id', 'articles.id')
       ->where("tag_id", $tag_id)
       ->latest('published_at')
       ->select('articles.*')
       ->latest('created_at')
       ->published()
       ->paginate(10); 
  }

}

 ?>