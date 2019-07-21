<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Tag;
 
class TagsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tags')->delete();
        
        $faker = Faker::create('en_US');
 
         for ($i = 0; $i < 10; $i++) {    // ③
            Tag::create([
                'name' => $faker->sentence()
            ]);
        }
    }
}
