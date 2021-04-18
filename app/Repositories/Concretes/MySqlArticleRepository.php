<?php

namespace App\Repositories\Concretes;


use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Eloquent\Article;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Domain\Entity\Article as ArticleEntity;

class MySqlArticleRepository implements ArticleRepositoryInterface
{

  public function findOne(int $articleId): \App\Domain\Entity\Article
  {
    $article = Article::where('id', $articleId)
      ->with(['tags'])
      ->first();

    return \App\Domain\Entity\Article::constructByRepository($article->title, $article->body, $article->image_path, $article->user_id, $article->id, $article->tags);
  }

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
    return Article::where('title', 'like', "%$searchWord%")
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

  public function store(int $userId, string $title, string $body, string $publishedAt, string $extension): ArticleEntity
  {
    $article = Article::create(['title' => $title, 'body' => $body,'published_at' => $publishedAt, 'user_id' => $userId]);

    $imagePath = "article_" . $article->id . "." . $extension;

    Article::where('id', $article->id)->update(['image_path' => $imagePath]);

    $article = Article::find($article->id);

    return ArticleEntity::constructByRepository(
      $article->title, $article->body, $article->image_path, $article->user_id, $article->id);
  }

    public function update(int $articleId, string $title, string $body, string $publishedAt, string $imagePath): void
    {
        Article::where('id', $articleId)
            ->update([
                'title' => $title,
                'body' => $body,
                'image_path' => $imagePath,
                'published_at' => $publishedAt,
        ]);
    }
}
