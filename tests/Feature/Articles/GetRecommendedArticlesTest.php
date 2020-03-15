<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Article;
use App\Services\GetRecommendedArticles;
use App\Tag;

class GetRecommendedArticlesTest extends TestCase
{
    //テスト終了後にデータベースを元に戻す
    use DatabaseTransactions;

    //タグがない記事を投げた時に記事が最新順で3件取得できるか
    public function test_success_no_tag_get_normal_articles() {

      $getRecommendedArticles = new GetRecommendedArticles();
      //認証用のユーザーを作成
      $user = factory(User::class)->create();
      $article = factory(Article::class)->create(['user_id' => $user->id]);
      $result = $getRecommendedArticles->get($article);

      $this->assertEquals(3, $result->count());
    }

    //同じタグの記事がなかった場合、普通の記事を最新順で3件取得できるか
    public function test_success_no_same_tag_get_normal_articles() {

      $getRecommendedArticles = new GetRecommendedArticles();
      $user = factory(User::class)->create();
      $article = factory(Article::class)->create(['user_id' => $user->id]);
      //新しいタグを作る必要がある
      $tag = Tag::create(['name' => 'test']);
      $article->tags()->attach($tag);

      $result = $getRecommendedArticles->get($article);

      $this->assertEquals(3, $result->count());
    }

    //同じタグの記事3件あった場合3件取得するか
    public function test_success_three_same_tag_get_recommended_articles() {

      $getRecommendedArticles = new GetRecommendedArticles();
      $user = factory(User::class)->create();
      $article = factory(Article::class)->create(['user_id' => $user->id]);

      //記事にタグを付ける
      $article->tags()->attach([0 => "1"]);

      //同じタグの記事を3件作成する
      $article_first = factory(Article::class)->create(['user_id' => $user->id]);
      $article_seconds = factory(Article::class)->create(['user_id' => $user->id]);
      $article_third = factory(Article::class)->create(['user_id' => $user->id]);
      $article_first->tags()->attach([0 => "1"]);
      $article_seconds->tags()->attach([0 => "1"]);
      $article_third->tags()->attach([0 => "1"]);

      $result = $getRecommendedArticles->get($article);

      $this->assertEquals(3, $result->count());
    }

  //同じタグの記事2件あった場合,2件取得し1件の最新で普通の記事を取得
  public function test_success_two_same_tag_get_recommended_articles() {

    $getRecommendedArticles = new GetRecommendedArticles();
    $user = factory(User::class)->create();
    $article = factory(Article::class)->create(['user_id' => $user->id]);

    //記事にタグを付ける
    $article->tags()->attach([0 => "1"]);

    //同じタグの記事を2件作成する
    $article_first = factory(Article::class)->create(['user_id' => $user->id]);
    $article_seconds = factory(Article::class)->create(['user_id' => $user->id]);
    $article_first->tags()->attach([0 => "1"]);
    $article_seconds->tags()->attach([0 => "1"]);

    $result = $getRecommendedArticles->get($article);

    $this->assertEquals(3, $result->count());
  }

  //同じタグの記事1件あった場合,1件取得し2件の最新で普通の記事を取得
  public function test_success_same_tag_get_recommended_articles() {

    $getRecommendedArticles = new GetRecommendedArticles();
    $user = factory(User::class)->create();
    $article = factory(Article::class)->create(['user_id' => $user->id]);

    //記事にタグを付ける
    $article->tags()->attach([0 => "1"]);

    //同じタグの記事を1件作成する
    $article_first = factory(Article::class)->create(['user_id' => $user->id]);
    $article_first->tags()->attach([0 => "1"]);

    $result = $getRecommendedArticles->get($article);

    $this->assertEquals(3, $result->count());
  }
}