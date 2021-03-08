<?php

namespace App\Policies;

use App\Eloquent\Article;
use App\Eloquent\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * 編集の表示が可能か
     *
     * @param  \App\User  $user
     * @param  Article  $article
     * @return bool
     */
    public function showEdit(User $user, Article $article)
    {
         return $user->id === $article->user_id;
    }

    /**
     * ユーザーにより指定されたポストが更新可能か決める
     *
     * @param  \App\User  $user
     * @param  Article  $article
     * @return bool
     */
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    /**
     * デリートが可能か決める
     *
     * @param  \App\User  $user
     * @param  Article  $article
     * @return bool
     */
    public function delete(User $user, Article $article)
    {
        //管理者はデリート権限あり
        if ($user->is_admin) {
            return true;
        }
        return $user->id === $article->user_id;
    }
}
