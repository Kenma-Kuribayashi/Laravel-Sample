<?php

namespace App\Domain\Entity;

final class User {

  private $user_name;
  private $is_contributor;

  private function __construct()
  {
  }

  public static function constructByRepository(string $user_name, bool $is_contributor) {
    $self = new self();

    $self->user_name = $user_name;
    $self->is_contributor = $is_contributor;

    return $self;
  }

  public function getName() {
    return $this->user_name;
  }
  
  public function isContributor() {
    return $this->is_contributor;
  }

}