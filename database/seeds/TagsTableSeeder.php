<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();
        
        // $faker = Faker::create('en_US');
 
        for ($i = 0; $i < 9; $i++) {
            switch ($i) {
                case 0:
                    Tag::create(['name' => "国内"]);
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
}
