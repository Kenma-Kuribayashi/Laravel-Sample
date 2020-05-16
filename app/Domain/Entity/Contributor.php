<?php

namespace App\Domain\Entity;

final class Contributor {

  private $user_id;

  private function __construct()
  {
  }

  public static function changeFromNormalUser(NormalUser $normalUser) {
    $self = new self();

    $self->user_id = $normalUser->getId();

    return $self;
  }

  public function getId() {
    return $this->user_id;
  }

}