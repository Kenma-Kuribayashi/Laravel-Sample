<?php

namespace App\Services;

use App\Repositories\Concretes\MySqlArticleRepository;

class GetArticles
{

  private $mySqlArticleRepository;

  public function __construct(MySqlArticleRepository $mySqlArticleRepository)
  {
    $this->mySqlArticleRepository = $mySqlArticleRepository;
  }

  public function execute(array $conditionsToGet)
  {

    $displayOrder = $conditionsToGet["sort"];
    $tagName = $conditionsToGet["tag"];
    $searchWord = $conditionsToGet["searchword"];

    // if ($searchWord) {

    // }

    if ($displayOrder === "new") {
      //タグが主要の時は全ての記事を取得し、指定のタグがあれば指定のタグの記事を取得する
      if ($tagName === "主要") {
        return $this->mySqlArticleRepository->getAllArticlesInNewOrder();
      } elseif ($tagName) {
        return $this->mySqlArticleRepository->getArticlesByTagInNewOrder($tagName);
      }
    } elseif ($displayOrder === "old") {
      if ($tagName === "主要") {
        return $this->mySqlArticleRepository->getAllArticlesInOldOrder();
      } elseif ($tagName) {
        return $this->mySqlArticleRepository->getArticlesByTagInOldOrder($tagName);
      }
    }
  }
}
