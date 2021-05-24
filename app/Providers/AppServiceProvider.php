<?php

namespace App\Providers;

use App\Repositories\Concretes\CacheGetBrowsingHistoriesRepository;
use App\Repositories\Concretes\MySqlUserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ViewCountRepositoryInterface;
use App\Repositories\Concretes\MySqlViewCountRepository;
use App\Repositories\Concretes\CacheViewCountRepository;
use App\Repositories\Concretes\MySqlContributorRepository;
use App\Repositories\Interfaces\GetBrowsingHistoriesRepositoryInterface;
use App\Repositories\Concretes\MySqlGetBrowsingHistoriesRepository;
use App\Repositories\Interfaces\RegisterContributorRepositoryInterface;
use App\Repositories\Concretes\MySqlRegisterContributorRepository;
use App\Repositories\Concretes\MySqlNormalUserRepository;
use App\Repositories\Interfaces\NormalUserRepositoryInterface;
use App\Repositories\Interfaces\ContributorRepositoryInterface;
use Illuminate\Database\MySqlConnection;
use App\Repositories\Interfaces\ArticleImagePathRepositoryInterface;
use App\Repositories\Concretes\MySqlArticleImagePathRepository;
use App\Repositories\Concretes\MySqlTagRepository;
use App\Repositories\Concretes\MySqlTransactionManagerRepository;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TransactionManagerInterface;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Concretes\MySqlArticleRepository;
use App\Repositories\Interfaces\ArticleTagRepositoryInterface;
use App\Repositories\Concretes\MySqlArticleTagRepository;
use App\Repositories\Concretes\S3ArticleImageRepository;
use App\Repositories\Interfaces\ArticleImageRepositoryInterface;

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
            ArticleTagRepositoryInterface::class,
            MySqlArticleTagRepository::class
        );

        $this->app->bind(
            ArticleImageRepositoryInterface::class,
            S3ArticleImageRepository::class
        );

        $this->app->bind(
            ViewCountRepositoryInterface::class,
            MySqlViewCountRepository::class
            //CacheViewCountRepository::class
        );

        $this->app->bind(
            GetBrowsingHistoriesRepositoryInterface::class,
            MySqlGetBrowsingHistoriesRepository::class

            //CacheGetBrowsingHistoriesRepository::class
        );

        //$this->app->bind(
        //     RegisterContributorRepositoryInterface::class,
        //     MySqlRegisterContributorRepository::class
        // );

        $this->app->bind(
            NormalUserRepositoryInterface::class,
            MySqlNormalUserRepository::class
        );

        $this->app->bind(
            ContributorRepositoryInterface::class,
            MySqlContributorRepository::class
        );

        $this->app->bind(
            ArticleImagePathRepositoryInterface::class,
            MySqlArticleImagePathRepository::class
        );

        $this->app->bind(
            TransactionManagerInterface::class,
            MySqlTransactionManagerRepository::class
        );

        $this->app->bind(
            TagRepositoryInterface::class,
            MySqlTagRepository::class
        );

        $this->app->bind(
            ArticleRepositoryInterface::class,
            MySqlArticleRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            MySqlUserRepository::class
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
