<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class StoreTest extends TestCase
{
    //テスト終了後にデータベースを元に戻す
    use DatabaseTransactions;

    //タイトルが3文字
    public function test_success_title_length_min()
    {
        //認証用のユーザーを作成
        $user = factory(User::class)->create();
        //3文字のランダムの文字列
        $new_title = str_random(3);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'user_id' => $user->id,
            'title' => $new_title,
            'body' => 'aaaaa',
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseHas('articles', [
          'title' => $new_title,
          'body' => 'aaaaa',
        ]);

        $response->assertRedirect();
    }

    //タイトルが50文字
    public function test_success_title_length_max()
    {
        $user = factory(User::class)->create();
        $new_title = str_random(50);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'user_id' => $user->id,
            'title' => $new_title,
            'body' => 'aaaaa',
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseHas('articles', [
          'title' => $new_title,
          'body' => 'aaaaa',
        ]);

        $response->assertRedirect();
    }
    
    //内容(body)が100文字
    public function test_success_body_length_max()
    {
        $user = factory(User::class)->create();
        $new_body = str_random(100);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'user_id' => $user->id,
            'title' => 'aaaaa',
            'body' => $new_body,
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseHas('articles', [
          'title' => 'aaaaa',
          'body' => $new_body,
        ]);

        $response->assertRedirect();
    }

    //タイトルがない
    public function test_failure_title_null()
    {
        $user = factory(User::class)->create();
        $new_body = str_random(10);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'user_id' => $user->id,
            'title' => '',
            'body' => $new_body,
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseMissing('articles', [
          'title' => '',
          'body' => $new_body,
        ]);

        $response->assertRedirect();
    }

    //タイトルが3文字より少ない
    public function test_failure_title_length_min()
    {
        $user = factory(User::class)->create();
        $new_body = str_random(10);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'user_id' => $user->id,
            'title' => 'aa',
            'body' => $new_body,
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseMissing('articles', [
          'title' => 'aa',
          'body' => $new_body,
        ]);

        $response->assertRedirect();
    }
    
    //タイトルが50文字より多い
    public function test_failure_title_length_max()
    {
        $user = factory(User::class)->create();
        $new_title = str_random(51);
        $new_body = str_random(10);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'user_id' => $user->id,
            'title' => $new_title,
            'body' => $new_body,
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseMissing('articles', [
          'title' => $new_title,
          'body' => $new_body,
        ]);

        $response->assertRedirect();
    }

    //bodyがない
    public function test_failure_body_null()
    {
        $user = factory(User::class)->create();
        $new_title = str_random(5);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'user_id' => $user->id,
            'title' => $new_title,
            'body' => '',
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseMissing('articles', [
          'title' => $new_title,
          'body' => '',
        ]);

        $response->assertRedirect();
    }

    //bodyが100文字より多い
    public function test_failure_body_length_max()
    {
        $user = factory(User::class)->create();
        $new_title = str_random(5);
        $new_body = str_random(101);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'title' => $new_title,
            'body' => $new_body,
            'published_at' => now(),
            'image' => '',
        ]);

        $this->assertDatabaseMissing('articles', [
          'title' => $new_title,
          'body' => $new_body,
        ]);

        $response->assertRedirect();
    }

    //published_atがない
    public function test_failure_published_at_null()
    {
        $user = factory(User::class)->create();
        $new_title = str_random(5);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'title' => $new_title,
            'body' => 'aaa',
            'published_at' => '',
            'image' => '',
        ]);

        $this->assertDatabaseMissing('articles', [
          'title' => $new_title,
          'body' => 'aaa',
        ]);

        $response->assertRedirect();
    }

    //published_atがdate型じゃない
    public function test_failure_published_at_date()
    {
        $user = factory(User::class)->create();
        $new_title = str_random(5);

        $response = $this->actingAs($user)
          ->post("/articles", [
            'title' => $new_title,
            'body' => 'aaa',
            'published_at' => 'aaaa-aa',
            'image' => '',
        ]);

        $this->assertDatabaseMissing('articles', [
          'title' => $new_title,
          'published_at' => 'aaaa-aa',
        ]);

        $response->assertRedirect();
    }

}