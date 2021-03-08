<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Eloquent\Tag;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Tag())->newQuery()->insert([
            [
                'id' => 1,
                'name' => '国内',
            ],
            [
                'id' => 2,
                'name' => '国際',
            ],
            [
                'id' => 3,
                'name' => '経済',
            ],
            [
                'id' => 4,
                'name' => 'エンタメ',
            ],
            [
                'id' => 5,
                'name' => 'スポーツ',
            ],
            [
                'id' => 6,
                'name' => 'IT',
            ],
            [
                'id' => 7,
                'name' => '科学',
            ],
            [
                'id' => 8,
                'name' => 'ライフ',
            ],
            [
                'id' => 9,
                'name' => '地域',
            ],
        ]);

    }
}
