<?php

namespace App\Services\AdminTop;

use App\Repositories\Concretes\GetUsersRepository;

class GetUsers {

  private $getUsersRepository;

  public function __construct(GetUsersRepository $getUsersRepository)
  {
    $this->getUsersRepository = $getUsersRepository;

  }

  public function getUsers() {
     return $this->getUsersRepository->get();
  }

}


 ?>