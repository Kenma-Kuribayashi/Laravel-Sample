<?php

namespace App\Services;

use App\Repositories\Interfaces\ArticleImagePathRepositoryInterface;
use App\Repositories\Interfaces\TransactionManagerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class StoreArticle
{

    private $articleImagePathRepository;
    private $transactionManagerRepository;

    public function __construct(
        ArticleImagePathRepositoryInterface $articleImagePathRepository,
        TransactionManagerInterface $transactionManagerRepository
    )
    {
        $this->articleImagePathRepository = $articleImagePathRepository;
        $this->transactionManagerRepository = $transactionManagerRepository;
    }

    public function store(array $params, int $tagId, $image)
    {
        $extension = $image->extension();

        try {
            $this->transactionManagerRepository->start();

            /**
             * Auth::user()のような形で Auth ファサードを使うとログイン中のユーザーの情報を取得できる。
             * articlesメソッドはArticleモデルとTagモデルが多対多の構造をつくる。
             *
             * @var App\Article
             */
            $article = Auth::user()->articles()->create($params);

            $article->tags()->attach($tagId); //attach多対対のとき

            $image_path = "article_" . $article->id . "." . $extension;

            //画像のパスを保存する
            $this->articleImagePathRepository->store($article->id, $image_path);

            // バケットの`myprefix`フォルダへアップロード
            Storage::disk('s3')->putFileAs('myprefix', $image, $image_path, 'public');

            $this->transactionManagerRepository->stop();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->transactionManagerRepository->rollBack();
            abort(422);
        }
    }
}


?>
