<?php

namespace App\Repositories\Concretes;

use App\BrowsingHistory as EloqentBrowsingHistory;
use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use Illuminate\Support\Collection;
use App\Domain\Entity\BrowsingHistory;
use Illuminate\Support\Carbon;

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
    /**
      * @var Collection
     */
     $collection = EloqentBrowsingHistory::where('user_id', $user_id)
        ->with('article')
        ->orderBy('id', 'desc')
        ->where('browse_date', Carbon::now()->format('Y-m-d'))
        ->limit(3)
        ->get();

      return $collection->map(function ($item) {
        return BrowsingHistory::constructByRepository($item->article->title, $item->article_id);
      });
  }
}