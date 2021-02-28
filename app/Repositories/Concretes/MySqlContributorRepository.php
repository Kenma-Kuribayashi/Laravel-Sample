<?php

namespace App\Repositories\Concretes;

use Illuminate\Support\Facades\DB;
use App\Domain\Entity\Contributor;
use App\Repositories\Interfaces\ContributorRepositoryInterface;

class MySqlContributorRepository implements ContributorRepositoryInterface
{
  public function __construct()
  {
  }

  /**
   * ユーザを取得する
   *
   * @param Contributor $contributor
   * @return void
   */
  public function create(Contributor $contributor): void
  {
    DB::table('users')->where('id', $contributor->getId())
    ->update(['is_contributor' => 1]);

  }
}