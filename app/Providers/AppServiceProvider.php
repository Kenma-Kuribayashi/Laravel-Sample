<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ViewCountRepositoryInterface;
use App\Repositories\Concretes\MySqlViewCountRepository;
use App\Repositories\Concretes\CacheViewCountRepository;
use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use App\Repositories\Concretes\MySqlGetBrowsingHistoriesRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ViewCountRepositoryInterface::class,
            MySqlViewCountRepository::class
            // CacheViewCountRepository::class
        );

        $this->app->bind(
            GetBrowsingHistoriesRepositoryInterface::class,
            MySqlGetBrowsingHistoriesRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
