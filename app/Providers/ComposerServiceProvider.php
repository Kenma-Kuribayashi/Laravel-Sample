<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['navbar', 'articles.*'],
            'App\Http\ViewComposers\AuthComposer'
        );

        //$weekのviewComposer
        View::composer(
            ['articles.index', 'articles.domestic', 'articles.show'],
            'App\Http\ViewComposers\WeekComposer'
        );
    }
}
