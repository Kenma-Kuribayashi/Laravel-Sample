<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;

class AuthComposer
{
    protected $users;

    /**
     * 新しいプロフィールコンポーザの生成
     *
     * @param  
     * @return void
     */
    public function __construct()
    {
        // 依存はサービスコンテナにより自動的に解決される
        $this->user = Auth::user();
    }

    /**
     * データをビューと結合
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'currentUser' => $this->user,
        ]);
    }
}