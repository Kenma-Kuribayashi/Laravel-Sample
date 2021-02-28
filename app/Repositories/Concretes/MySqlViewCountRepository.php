<?php

namespace App\Repositories\Concretes;

use App\BrowsingHistory;
use App\Repositories\Interfaces\ViewCountRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;

class MySqlViewCountRepository implements ViewCountRepositoryInterface
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
    DB::beginTransaction();

    $browsingHistory = BrowsingHistory::where('article_id', $article_id)
      ->where('user_id', $user_id)
      ->where('browse_date', Carbon::now()->format('Y-m-d'))
      ->first();

      try {
        if ($browsingHistory === NULL) {
          BrowsingHistory::create(
            ['article_id' => $article_id,
              'user_id' => $user_id,
              'browse_date' => Carbon::now()->format('Y-m-d')
            ]
          );
        } else {
          $browsingHistory->updated_at = Carbon::now();
          $browsingHistory->save();
        }
      } catch (Exception $e) {
        $e->getMessage();
        DB::rollBack();
      }

    DB::commit();
  }
}
