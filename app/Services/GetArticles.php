<?php

namespace App\Services;

use App\Repositories\Concretes\MySqlArticleRepository;

class GetArticles {

  private $mySqlArticleRepository;

  public function __construct(MySqlArticleRepository $mySqlArticleRepository) {
    $this->mySqlArticleRepository = $mySqlArticleRepository;
  }

  public function execute(string $tagName) {

    //タグが主要の時は全ての記事を取得し、指定のタグがあれば指定のタグの記事を取得する
    if ($tagName === "主要") {
      return $this->mySqlArticleRepository->getAllArticles();
    } elseif ($tagName) {
      return $this->mySqlArticleRepository->getArticlesByTag($tagName);
    }

  }

}
