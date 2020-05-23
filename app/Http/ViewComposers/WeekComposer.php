<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class WeekComposer
{

    /**
     * 新しいプロフィールコンポーザの生成
     *
     * @param  
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * データをビューと結合
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
      $week = ['日','月','火','水', '木', '金', '土'];

        $view->with([
            'week' => $week,
        ]);
    }
}