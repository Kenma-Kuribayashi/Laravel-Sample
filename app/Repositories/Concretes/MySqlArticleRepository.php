<?php

namespace App\Repositories\Concretes;


use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Eloquent\Article;
use Illuminate\Pagination\LengthAwarePaginator;


class MySqlArticleRepository implements ArticleRepositoryInterface
{

  public function getAllArticlesInNewOrder(): LengthAwarePaginator
  {
        return Article::latest('published_at')
        ->latest('created_at')
        ->published()
        ->paginate(10);
  }

  public function getArticlesByTagInNewOrder(string $tagName): LengthAwarePaginator
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

  public function getAllArticlesInOldOrder(): LengthAwarePaginator
  {
        return Article::oldest('published_at')
        ->oldest('created_at')
        ->published()
        ->paginate(10);
  }

  public function getArticlesByTagInOldOrder(string $tagName): LengthAwarePaginator
  {
        //withだとtagの条件が反映されなかった
        return Article::join('article_tag', 'article_tag.article_id', 'articles.id')
        ->join('tags', 'tags.id', 'article_tag.tag_id')
        ->where("name", $tagName)
        ->oldest('published_at')
        ->select('articles.*')
        ->oldest('created_at')
        ->published()
        ->paginate(10);
  }

  /**
   *
   * @param int|string $searchWord
   * @return LengthAwarePaginator
   */
  public function getArticlesByBySearchWord($searchWord): LengthAwarePaginator
  {
        return Article::
        where('title', 'like', "%$searchWord%")
        ->orWhere('body', 'like', "%$searchWord%")
        ->latest('published_at')
        ->latest('created_at')
        ->published()
        ->paginate(10);
  }

  public function delete(int $articleId): void
  {
    Article::where('id', $articleId)->delete();
  }
}
}
