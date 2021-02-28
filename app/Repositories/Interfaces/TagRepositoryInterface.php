<?php
namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface TagRepositoryInterface
{
  /**
   *
   * @return Collection
   */  
  public function getAllTags(): Collection;
}