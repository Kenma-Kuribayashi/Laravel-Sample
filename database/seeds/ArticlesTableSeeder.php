<?php

use Illuminate\Database\Seeder;
 
class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->delete();
 
        $user = App\User::first(); 
 
        factory(App\Article::class, 20)->create([ 
            'user_id' => $user->id,
        ]);
    }
}

