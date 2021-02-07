<?php

namespace App\Services;


use App\Repositories\Interfaces\TransactionManagerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\ArticleImageRepositoryInterface;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\ArticleTagRepositoryInterface;
use App\Domain\Entity\Article;

class StoreArticle
{

    private $articleImageRepository;
    private $transactionManagerRepository;
    private $articleRepository;
    private $articleTagRepository;

    public function __construct(
        ArticleImageRepositoryInterface $articleImageRepository,
        TransactionManagerInterface $transactionManagerRepository,
        ArticleRepositoryInterface $articleRepository,
        ArticleTagRepositoryInterface $articleTagRepository
    )
    {
        $this->articleImageRepository = $articleImageRepository;
        $this->transactionManagerRepository = $transactionManagerRepository;
        $this->articleRepository = $articleRepository;
        $this->articleTagRepository = $articleTagRepository;
    }

    public function store(array $request)
    {
        $user = Auth::user();
        $title = $request['title'];
        
        $body = $request['body'];
        $publishedAt = $request['published_at'];
        $tagId = $request['tag_id'];
        $image =$request['image'];

        $extension = $image->extension();

        try {
            $this->transactionManagerRepository->start();

            /**
             * @var Article
             */
            $article = $this->articleRepository->store($user->id, $title, $body, $publishedAt, $extension);

            $this->articleTagRepository->store($article->getId(), $tagId);

            // $this->articleImageRepository->upload($image, $article->getImagePath());

            $this->transactionManagerRepository->stop();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->transactionManagerRepository->rollBack();
            abort(422);
        }
    }
}


?>
