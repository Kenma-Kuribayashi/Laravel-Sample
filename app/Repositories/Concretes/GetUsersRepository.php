<?php

namespace App\Repositories\Concretes;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Entity\User;

class GetUsersRepository
{
  public function __construct()
  {
  }

  /**
   * ユーザー一覧をid順に取得する
   *
   * @return Collection
   */
  public function get() :Collection {
    
    $collection = DB::table('users')->orderBy('id')->get();
    
    return $collection->map(function ($item) {
      return User::constructByRepository($item->id, $item->name, $item->is_contributor);
    });

  }
}