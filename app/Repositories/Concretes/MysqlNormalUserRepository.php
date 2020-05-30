<?php

namespace App\Repositories\Concretes;

use App\Repositories\Interfaces\NormalUserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Domain\Entity\NormalUser;

class MySqlNormalUserRepository implements NormalUserRepositoryInterface
{
  public function __construct()
  {
  }

  /**
   * ユーザを取得してNormalUserエンティティを返す
   *
   * @param integer $user_id
   * @return NormalUser $normalUser
   */
  public function find(int $user_id): ?NormalUser
  {
    $user = DB::table('users')->where('id', $user_id)
      ->where('is_contributor', false)->first();

    if ($user === NULL) {
      return $user;
    }

    return NormalUser::constructByRepository($user->id);
  }
}