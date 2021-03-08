<?php

use Illuminate\Database\Seeder;
use App\Eloquent\ArticleTag;

class ArticleTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ArticleTag::class, 20)->create();
    }
}
