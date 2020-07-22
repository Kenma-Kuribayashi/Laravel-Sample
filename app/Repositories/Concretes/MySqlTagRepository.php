<?php

namespace App\Repositories\Concretes;


use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class MySqlTagRepository implements TagRepositoryInterface
{
  public function getAllTags(): Collection
  {
    return DB::table('tags')->orderBy('id')->get();
  }
}