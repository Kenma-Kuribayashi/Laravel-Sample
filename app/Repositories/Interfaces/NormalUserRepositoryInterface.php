<?php
namespace App\Repositories\Interfaces;

use App\Domain\Entity\NormalUser;

interface NormalUserRepositoryInterface
{
  /**
   * Undocumented function
   *
   * @param integer $user_id
   * @return NormalUser $normalUser
   */  
  public function find(int $user_id): NormalUser;
}