<?php
namespace App\Repositories\Interfaces;

use App\Domain\Entity\Contributor;

interface ContributorRepositoryInterface
{
  /**
   * Undocumented function
   *
   * @param Contributor $contributor
   * @return void
   */  
  public function create(Contributor $contributor): void;
}