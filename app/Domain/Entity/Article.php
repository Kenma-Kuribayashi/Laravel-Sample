<?php

namespace App\Domain\Entity;

use Illuminate\Support\Collection;

final class Article {

  private $article_title;
  private $article_body;
  private $article_image_path;
  private $article_user_id;
  private $article_id;
  private $article_tags;

  private function __construct()
  {
  }

  public static function constructByRepository(string $article_title, string $article_body, string $article_image_path = null, int $article_user_id, int $article_id, Collection $article_tags = null) {
    $self = new self();

    $self->article_title = $article_title;
    $self->article_body = $article_body;
    $self->article_image_path = $article_image_path;
    $self->article_user_id = $article_user_id;
    $self->article_id = $article_id;
    $self->article_tags = $article_tags;

    return $self;
  }

  public function getTitle() {
    return $this->article_title;
  }

  public function getBody() {
    return $this->article_body;
  }

  public function hasImagePath(): bool
  {
    if ($this->article_image_path === NULL) {
      return false;
    }
    return true;
  }

  public function getImagePath() {
    $image_path = "https://test-bucket-sample-news.s3-ap-northeast-1.amazonaws.com/myprefix/{$this->article_image_path}";

    return $image_path;
  }

  public function getUserId() {
    return $this->article_user_id;
  }

  public function getArticleId() {
    return $this->article_id;
  }

  public function hasTags() {
    if ($this->article_tags === NULL) {
      return false;
    }
    return true;
  }

  public function getTags() {
    return $this->article_tags;
  }
}