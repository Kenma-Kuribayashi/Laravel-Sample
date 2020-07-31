<?php

namespace App\Repositories\Concretes;


use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Article;
use Illuminate\Pagination\LengthAwarePaginator;


class MySqlArticleRepository implements ArticleRepositoryInterface
{

  public function getAllArticles(): LengthAwarePaginator
  {
        return Article::latest('published_at')
        ->latest('created_at')
        ->published()
        ->paginate(10);
  }

  public function getArticlesByTag(string $tagName): LengthAwarePaginator
  {
        //withだとtagの条件が反映されなかった
        return Article::join('article_tag', 'article_tag.article_id', 'articles.id')
        ->join('tags', 'tags.id', 'article_tag.tag_id')
        ->where("name", $tagName)
        ->latest('published_at')
        ->select('articles.*')
        ->latest('created_at')
        ->published()
        ->paginate(10);
  }
}