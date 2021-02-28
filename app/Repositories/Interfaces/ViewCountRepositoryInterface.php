<?php
namespace App\Repositories\Interfaces;

interface ViewCountRepositoryInterface
{
    public function incrementViewCount(int $article_id, int $user_id, string $article_title);
}