<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Eloquent\User;
use App\Eloquent\Article;
use App\Services\GetRecommendedArticles;
use App\Eloquent\Tag;
use Illuminate\Database\Eloquent\Collection;

class GetRecommendedArticlesTest extends TestCase
{
  //テスト終了後にデータベースを元に戻す
  use DatabaseTransactions;

  private $user;
  private $article;
  private $article_first;
  private $article_seconds;
  private $article_third;
  private $article_fourth;

  protected function setUp():void
  {
      parent::setUp();

      //認証用のユーザーを作成
      $this->user = factory(User::class)->create();
      $this->article = factory(Article::class)->create(['user_id' => $this->user->id]);
      //最新記事のダミーを4件作成(4件の中で最新の記事を取得するか確認するため)
      $this->article_first = factory(Article::class)->create(['user_id' => $this->user->id]);
      $this->article_seconds = factory(Article::class)->create(['user_id' => $this->user->id]);
      $this->article_third = factory(Article::class)->create(['user_id' => $this->user->id]);
      $this->article_fourth = factory(Article::class)->create(['user_id' => $this->user->id]);
  }

  //タグがない記事を投げた時に記事が最新順で3件取得できるか
  public function test_success_no_tag_get_normal_articles() {
    $getRecommendedArticles = new GetRecommendedArticles();
    /**
     * @var Collection
     */
    $result = $getRecommendedArticles->get($this->article->id);

    //取得した3件の記事のidを取得した順に配列に入れる
    $plucked = $result->pluck('id');
    //作成した最新記事3件と取得した3件の記事のidが同じか
    $this->assertEquals([
      $this->article_fourth->id,
      $this->article_third->id,
      $this->article_seconds->id,
    ], $plucked->all());

    $this->assertEquals(3, $result->count());
  }

  //同じタグの記事がなかった場合、普通の記事を最新順で3件取得できるか
  public function test_success_no_same_tag_get_normal_articles() {
    $getRecommendedArticles = new GetRecommendedArticles();
    //新しいタグを作る必要がある
    $tag = Tag::create(['name' => 'test']);
    $this->article->tags()->attach($tag);

    /**
     * @var Collection
     */
    $result = $getRecommendedArticles->get($this->article->id);

    $plucked = $result->pluck('id');

    $this->assertEquals([
      $this->article_fourth->id,
      $this->article_third->id,
      $this->article_seconds->id,
    ], $plucked->all());

    $this->assertEquals(3, $result->count());
  }

  //同じタグの記事3件あった場合3件取得するか
  public function test_success_three_same_tag_get_recommended_articles() {

    $getRecommendedArticles = new GetRecommendedArticles();

    //記事にタグを付ける
    $this->article->tags()->attach([0 => "1"]);

    //同じタグの記事を4件作成する(4件の中で最新の記事を取得するか確認するため)
    $this->article_first->tags()->attach([0 => "1"]);
    $this->article_seconds->tags()->attach([0 => "1"]);
    $this->article_third->tags()->attach([0 => "1"]);
    $this->article_fourth->tags()->attach([0 => "1"]);

    $result = $getRecommendedArticles->get($this->article->id);

    $plucked = $result->pluck('id');

    $this->assertEquals([
      $this->article_fourth->id,
      $this->article_third->id,
      $this->article_seconds->id,
    ], $plucked->all());

    $this->assertEquals(3, $result->count());
  }

  //同じタグの記事2件あった場合,2件取得し1件の最新で普通の記事を取得
  public function test_success_two_same_tag_get_recommended_articles() {

    $getRecommendedArticles = new GetRecommendedArticles();

    //新しいタグを作る必要がある
    $tag = Tag::create(['name' => 'test']);
    $this->article->tags()->attach($tag);

    //同じタグの記事を2件作成する(3件作ると同じタグの記事3件のテストになってしまう)
    $this->article_first->tags()->attach($tag);
    $this->article_seconds->tags()->attach($tag);

    $result = $getRecommendedArticles->get($this->article->id);

    $plucked = $result->pluck('id');

    $this->assertEquals([
      $this->article_seconds->id,
      $this->article_first->id,
      $this->article_fourth->id,
    ], $plucked->all());

    $this->assertEquals(3, $result->count());
  }

  //同じタグの記事1件あった場合,1件取得し2件の最新で普通の記事を取得
  public function test_success_same_tag_get_recommended_articles() {
    $getRecommendedArticles = new GetRecommendedArticles();

    //新しいタグを作る必要がある
    $tag = Tag::create(['name' => 'test']);
    $this->article->tags()->attach($tag);

    //同じタグの記事を1件作成する
    $this->article_first->tags()->attach($tag);

    $result = $getRecommendedArticles->get($this->article->id);
    $plucked = $result->pluck('id');

    $this->assertEquals([
      $this->article_first->id,
      $this->article_fourth->id,
      $this->article_third->id,
    ], $plucked->all());

    $this->assertEquals(3, $result->count());
  }
}