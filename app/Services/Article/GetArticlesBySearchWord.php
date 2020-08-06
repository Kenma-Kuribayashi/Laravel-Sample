<?php

namespace App\Services\Article;

use App\Repositories\Concretes\MySqlArticleRepository;

class GetArticlesBySearchWord {

  private $mySqlArticleRepository;

  public function __construct(MySqlArticleRepository $mySqlArticleRepository)
  {
    $this->mySqlArticleRepository = $mySqlArticleRepository;
  }

  public function execute($searchWord)
  {
      return $this->mySqlArticleRepository->getArticlesByBySearchWord($searchWord);
  }

}

 ?>