<?php

namespace App\Repositories\Concretes;

use App\BrowsingHistory;
use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class MySqlGetBrowsingHistoriesRepository implements GetBrowsingHistoriesRepositoryInterface
{
  public function __construct()
  {
  }

  /**
   * 閲覧した記事を直近に閲覧した順に返す
   *
   * @param integer $user_id
   * @return Collection
   */
  public function getBrowsingHistories(int $user_id) :Collection
  {
     return BrowsingHistory::where('user_id', $user_id)
      ->with('article')
      ->orderBy('id', 'desc')
      ->get();
  }
}