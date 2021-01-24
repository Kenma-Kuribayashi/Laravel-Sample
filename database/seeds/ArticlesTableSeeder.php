<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Eloquent\Article;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->delete();
 
        $user = App\Eloquent\User::first(); 
 
        for ($i = 0; $i < 1; $i++) {
            switch ($i) {
                case 0:
                    Article::create([
                        'title' => "aaa",
                        'body' => "aaa",
                        'published_at' => Carbon::today(),
                        'user_id' => $user -> id,
                        // 'user_id' => function () {
                        //     return factory(App\User::class)->create()->id;
                        // },
                    ]);
                    break;
                case 1:
                    Tag::create(['name' => "国際"]);
                    break;
                case 2:
                    Tag::create(['name' => "経済"]);
                    break;
                case 3:
                    Tag::create(['name' => "エンタメ"]);
                    break;
                case 4:
                    Tag::create(['name' => "スポーツ"]);
                    break;
                case 5:
                    Tag::create(['name' => "IT"]);
                    break;
                case 6:
                    Tag::create(['name' => "科学"]);
                    break;
                case 7:
                    Tag::create(['name' => "ライフ"]);
                    break;
                case 8:
                    Tag::create(['name' => "地域"]);
                    break;
            }
    }
}

