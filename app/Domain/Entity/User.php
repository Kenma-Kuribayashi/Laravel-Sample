<?php

namespace App\Domain\Entity;

final class User {

  private $user_id;
  private $user_name;
  private $is_contributor;

  private function __construct()
  {
  }

  public static function constructByRepository(int $user_id, string $user_name, bool $is_contributor) {
    $self = new self();

    $self->user_id = $user_id;
    $self->user_name = $user_name;
    $self->is_contributor = $is_contributor;

    return $self;
  }

  public function getId() {
    return $this->user_id;
  }

  public function getName() {
    return $this->user_name;
  }
  
  public function isContributor() {
    return $this->is_contributor;
  }

}