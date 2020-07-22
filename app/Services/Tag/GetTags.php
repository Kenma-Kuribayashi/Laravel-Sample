<?php

namespace App\Services\Tag;

use App\Repositories\Interfaces\TagRepositoryInterface;


class GetTags {

  private $tagRepositoryInterface;

  public function __construct(TagRepositoryInterface $tagRepositoryInterface)
  {
    $this->tagRepositoryInterface = $tagRepositoryInterface;
  }

  
  public function execute() {

    return $this->tagRepositoryInterface->getAllTags();
      
  }

}

 ?>