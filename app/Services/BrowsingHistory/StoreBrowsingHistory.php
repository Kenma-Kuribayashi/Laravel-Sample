<?php

namespace App\Services\BrowsingHistory;

use App\Repositories\Interfaces\ViewCountRepositoryInterface;
use App\Services\GetArticle;

class StoreBrowsingHistory {

    /**
     * @var ViewCountRepositoryInterface
     */
    private $viewCountRepository;

    /**
     * StoreBrowsingHistory constructor.
     *
     * @param ViewCountRepositoryInterface $viewCountRepository
     */
    public function __construct(ViewCountRepositoryInterface $viewCountRepository)
    {
        $this->viewCountRepository = $viewCountRepository;
    }

  /**
   * ログインユーザが記事詳細ページ開いたら記事のidとユーザのidを保存する
   *
   * @param int $user_id
   * @param int $article_id
   * @param GetArticle $get_article
   * @return void
   */
  public function store(int $article_id, int $user_id = null,$get_article) {
    
    if ($user_id) {
      $article = $get_article->get_article($article_id);
      
      $this->viewCountRepository->incrementViewCount($article_id, $user_id, $article->title);
    }

  }

}


?>