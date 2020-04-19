<?php

namespace App\Repositories\Concretes;

use App\BrowsingHistory;
use App\Repositories\Interfaces\ViewCountRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use App\Article;

class CacheViewCountRepository implements ViewCountRepositoryInterface
{
  public function __construct()
  {
  }

  /**
   * 閲覧した記事とユーザidを保存する。
   * updateOrCreate()では実装できなかった。
   *
   * @param integer $article_id
   * @param integer $user_id
   * @param string $article_title
   * @return void
   */
  public function incrementViewCount(int $article_id, int $user_id, string $article_title)
  {

    $value = [
      'article_id' => $article_id,
      'user_id' => $user_id,
      'article_title' => $article_title,
      'browse_date' => Carbon::now()->format('Y-m-d')
    ];

    $expiresAt = now()->addMinutes(10);

    //まだ履歴がない時はあるか確認してなれば作る
    for ($id = 1; $id <= 3; $id++) {
      if (Cache::has("article.view_history.{$user_id}.{$id}") === false) {
        return Cache::add("article.view_history.{$user_id}.{$id}", $value, $expiresAt);
      }
    }
    //すでに3件ある時は3件取得して一番古い履歴に上書きする
    $browsingHistory_first = Cache::get("article.view_history.{$user_id}.1");

    dd($browsingHistory_first);
    

    

  }
}