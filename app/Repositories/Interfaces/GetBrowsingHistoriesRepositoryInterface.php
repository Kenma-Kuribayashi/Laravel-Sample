<?php
namespace App\Repositories\Interfaces;

interface GetBrowsingHistoriesRepositoryInterface
{
    public function getBrowsingHistories(int $user_id);
}