<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Contributor;

final class NormalUser {

  private $user_id;

  private function __construct()
  {
  }

  public static function constructByRepository(int $user_id) {
    $self = new self();

    $self->user_id = $user_id;

    return $self;
  }

  public function getId() {
    return $this->user_id;
  }

  public function changeToContributor(NormalUser $normalUser) {
    return Contributor::changeFromNormalUser($normalUser);
  }

}