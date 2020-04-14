<?php
namespace App\Repositories\Interfaces;

interface GetBrowsingHistoriesRepositoryInterface
{
    /**
     * 
     * @param integer $user_id
     * @return Collection
     */
    public function getBrowsingHistories(int $user_id);
}