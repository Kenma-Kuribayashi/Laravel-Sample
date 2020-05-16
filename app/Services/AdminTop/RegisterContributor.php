<?php

namespace App\Services\AdminTop;

use App\Domain\Entity\NormalUser;
use App\Repositories\Interfaces\ContributorRepositoryInterface;
use App\Repositories\Interfaces\NormalUserRepositoryInterface;

class RegisterContributor {

  private $normalUserRepositoryInterface;
  private $contributorRepositoryInterface;
  
  /**
   * Undocumented function
   *
   * 
   */
  public function __construct(NormalUserRepositoryInterface $normalUserRepositoryInterface, ContributorRepositoryInterface $contributorRepositoryInterface) {
     
    $this->normalUserRepositoryInterface = $normalUserRepositoryInterface;
    $this->contributorRepositoryInterface = $contributorRepositoryInterface;
  
  }

  /**
   * 一般ユーザを投稿者ユーザに登録する
   *
   * @param int $user_id
   * @return void
   */
  public function registerContributor(int $user_id) {

    /**
     * 登録したいユーザを取得
     * 
     * @var NormalUser $user
     */
    $user = $this->normalUserRepositoryInterface->find($user_id);

    /**
     * NormalUserエンティティをContributorエンティティに変える
     */
    $contributor = $user->changeToContributor($user);

    /**
     * userテーブルのis_contributorを変更する
     */
    $this->contributorRepositoryInterface->create($contributor);

  }

}

?>