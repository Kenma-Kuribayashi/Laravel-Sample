<?php

namespace App\Repositories\Concretes;

use App\BrowsingHistory as EloqentBrowsingHistory;
use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use Illuminate\Support\Collection;
use App\Domain\Entity\BlowsingHistory;

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
      ->get();

      return $collection->map(function ($item) {
        return BlowsingHistory::constructByRepository($item->article->title, $item->article_id);
      });
  }
}