<?php

use Illuminate\Database\Seeder;
 
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            //ArticlesTableSeeder::class,
            TagsTableSeeder::class,
            ArticleTagTableSeeder::class,
        ]);
    }
}
