<?php

namespace App\Domain\Entity;

final class BrowsingHistory {

  private $article_title;
  private $article_id;

  private function __construct()
  {
  }

  public static function constructByRepository(string $article_title, string $article_id) {
    $self = new self();

    $self->article_title = $article_title;
    $self->article_id = $article_id;

    return $self;
  }

  public function getTitle() {
    return $this->article_title;
  }

  

}