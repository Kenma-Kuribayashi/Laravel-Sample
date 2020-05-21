<?php

namespace App\Domain\Entity;

final class Contributor {

  private $user_id;

  private function __construct()
  {
  }

  public static function changeFromNormalUser(NormalUser $normalUser) {
    //既に投稿者に登録されていたら422を返す
    if ($normalUser->isContributor()) {abort(422);}
    
    $self = new self();

    $self->user_id = $normalUser->getId();

    return $self;
  }

  public function getId() {
    return $this->user_id;
  }

}