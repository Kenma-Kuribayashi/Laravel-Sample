<?php

namespace App\Services\BrowsingHistory;

use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetBrowsingHistories {

    /**
     * @var GetBrowsingHistoriesRepositoryInterface
     */
    private $getBrowsingHistoriesRepository;

    /**
     * GetBrowsingHistories constructor.
     *
     * @param GetBrowsingHistoriesRepositoryInterface $getBrowsingHistoriesRepository
     */
    public function __construct(GetBrowsingHistoriesRepositoryInterface $getBrowsingHistoriesRepository)
    {
        $this->getBrowsingHistoriesRepository = $getBrowsingHistoriesRepository;
    }

  /**
   * ログインしてるユーザーの閲覧履歴を取得する
   *
   * @param int $user_id
   * @return Collection
   */
  public function get(int $user_id) {
    
    return $this->getBrowsingHistoriesRepository->getBrowsingHistories($user_id);

  }
}

?>