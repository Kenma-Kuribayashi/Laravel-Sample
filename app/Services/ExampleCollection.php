<?php

namespace App\Services;

use Illuminate\Support\Collection;
use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Countable;
use IteratorAggregate;
use App\Eloquent\User;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ExampleCollection {

  /**
   * 特定の記事を取得する。
   * 
   * @var 
   * @param Arrayable $collection
   * @return Collection
   */
  public function getCollection(Arrayable $collection) {

    $multiplied = $collection->toArray();

    dd($multiplied);

    return $multiplied;
      
  }

  /**
   * 
   * 
   * @var 
   * @param AuthenticatableContract $user
   * @return User
   */
  public function getUser(AuthenticatableContract $user) {

    $user->name = "masao";

    return $user;
      
  }

}

 ?>