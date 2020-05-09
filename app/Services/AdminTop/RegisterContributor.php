<?php

namespace App\Services\AdminTop;

use App\Repositories\Interfaces\RegisterContributorRepositoryInterface;
use App\Services\GetArticle;

class RegisterContributor {

  private $registerContributorRepository;
  
  /**
   * Undocumented function
   *
   * @param RegisterContributorRepositoryInterface $registerContributorRepository
   */
  public function __construct(RegisterContributorRepositoryInterface $registerContributorRepository) {
     
    $this->registerContributorRepository = $registerContributorRepository;
  
  }

  /**
   *
   * @param int $user_id
   * @return void
   */
  public function registerContributor(int $user_id) {
    
    $this->registerContributorRepository->registerContributor($user_id);

  }

}

?>