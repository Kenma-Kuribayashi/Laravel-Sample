<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Contributor;

final class NormalUser {

  private $user_id;
  private $is_contributor;

  private function __construct()
  {
  }

  public static function constructByRepository(int $user_id, bool $is_contributor) {
    $self = new self();

    $self->user_id = $user_id;
    $self->is_contributor = $is_contributor;

    return $self;
  }

  public function getId() {
    return $this->user_id;
  }

  public function isContributor() {
    return $this->is_contributor;
  }

}