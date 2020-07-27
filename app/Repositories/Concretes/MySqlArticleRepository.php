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
        return Article::latest('published_at')
        ->latest('created_at')
        ->published()
        ->whereHas('tags', function ($query) use($tagName) {
            $query->where('name', $tagName);
          })
          ->paginate(10);
  }
}