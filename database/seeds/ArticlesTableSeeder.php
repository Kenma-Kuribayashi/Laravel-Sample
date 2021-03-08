<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Eloquent\Article;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        factory(Article::class, 20)->create();
    }
}

