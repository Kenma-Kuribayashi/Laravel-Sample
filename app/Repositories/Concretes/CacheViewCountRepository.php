<?php

namespace App\Repositories\Concretes;

use App\BrowsingHistory;
use App\Repositories\Interfaces\ViewCountRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;

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
   * @return void
   */
  public function incrementViewCount(int $article_id, int $user_id)
  {

    $value = [
      'article_id' => $article_id,
      'user_id' => $user_id,
      'browse_date' => Carbon::now()->format('Y-m-d')
    ];

    //dd($value);

    Cache::put("article.view_history.{$user_id}", $value, 30);

  }
}