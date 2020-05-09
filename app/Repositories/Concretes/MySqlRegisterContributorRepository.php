<?php

namespace App\Repositories\Concretes;


use App\Repositories\Interfaces\RegisterContributorRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MySqlRegisterContributorRepository implements RegisterContributorRepositoryInterface
{
  public function __construct()
  {
  }

  /**
   * is_contributorカラムをTrueにする
   *
   * @param integer $user_id
   * @return void
   */
  public function registerContributor(int $user_id)
  {
    DB::table('users')->where('id', $user_id)
      ->update(['is_contributor' => 1]);
  }
}