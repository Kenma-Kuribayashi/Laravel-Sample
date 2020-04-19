<?php

namespace App\Repositories\Concretes;

use App\BrowsingHistory;
use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use Illuminate\Support\Facades\Cache;

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
    public function getBrowsingHistories(int $user_id) {

      //$value = Cache::get("article.view_history.{$user_id}");

      $collection = collect();

      for ($id = 1; $id <= 3; $id++) {

        $value = Cache::get("article.view_history.{$user_id}.{$id}");
        $collection->push($value);
      
      }

      dd($collection);

      return collect()->push($value);

    }
}