<?php

namespace App\Repositories\Concretes;

use App\Repositories\Interfaces\ViewCountRepositoryInterface;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\GetCacheNotArrayException;

class CacheViewCountRepository implements ViewCountRepositoryInterface
{
  public function __construct()
  {
  }

  /**
   * 閲覧した記事とユーザidを保存する。
   *
   * @param integer $article_id
   * @param integer $user_id
   * @param string $article_title
   * @return void
   */
  public function incrementViewCount(int $article_id, int $user_id, string $article_title)
  {
    $current_history = [
      'article_id' => $article_id,
      'user_id' => $user_id,
      'article_title' => $article_title,
      'browse_date' => Carbon::now()->format('Y-m-d')
    ];

    $expiresAt = now()->addMinutes(1440);

    //閲覧履歴がなれば作る
    if (Cache::has("article.view_history.{$user_id}") === false) {
      return Cache::add(
        "article.view_history.{$user_id}",
        // 閲覧履歴の連想配列を配列に入れる
        [$current_history],
        $expiresAt
      );
    }

    /**
     * @var array
     */
    $saved_history = Cache::get("article.view_history.{$user_id}");
    // 万が一配列じゃなかったら例外
    if (!is_array($saved_history)) {
      throw new GetCacheNotArrayException();
    }

    //配列に新しい閲覧履歴をpushする
    $saved_history[] = $current_history;
    //閲覧履歴が3より多くあれば古い履歴を削除する
    if (count($saved_history) > 3) {
      array_shift($saved_history);
    }

    //add()にすると同じkeyがあると更新されないためputにしている
    return Cache::put(
      "article.view_history.{$user_id}",
      $saved_history,
      $expiresAt
    );
  }
}