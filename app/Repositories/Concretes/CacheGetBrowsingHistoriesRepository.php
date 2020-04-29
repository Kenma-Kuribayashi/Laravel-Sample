<?php

namespace App\Repositories\Concretes;

use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use App\Domain\Entity\BrowsingHistory;

class CacheGetBrowsingHistoriesRepository implements GetBrowsingHistoriesRepositoryInterface
{
  public function __construct()
  {
  }

    /**
     * 
     * @param integer $user_id
     * @return Collection
     */
    public function getBrowsingHistories(int $user_id) :Collection
    {
      $saved_histories = Cache::get("article.view_history.{$user_id}");

      $collection = collect();

      //閲覧履歴がなければ空のコレクションを返す
      if ($saved_histories === null) {
        return $collection;
      }

      $collection = Collection::make($saved_histories);

      return $collection->map(function ($item) {
        return BrowsingHistory::constructByRepository($item['article_title'], $item['article_id']);
      });

    }
}