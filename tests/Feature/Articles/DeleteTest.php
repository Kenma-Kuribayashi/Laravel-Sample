<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Article;

class DeleteTest extends TestCase
{
    //テスト終了後にデータベースを元に戻す
    use DatabaseTransactions;

    //成功
      //user1が記事作成し削除
      //user1が記事作成し、管理者が削除
    //失敗
      //user2の記事作成しuser1が削除

    //user1が記事作成し削除
    public function test_success_my_article_delete()
    {
        //認証用のユーザーを作成
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
          ->delete("/articles/{$article->id}");

        $this->assertDatabaseMissing('articles', [
          'id' => $article->id,
          'title' => $article->title,
        ]);

        $response->assertRedirect();
    }

    //user1が記事作成し、管理者が削除
    // public function test_success_admin_delete()
    // {
    //     $user = factory(User::class)->create();
    //     $admin_user = factory(User::class)->create(['is_admin' => 1]);
    //     $article = factory(Article::class)->create(['user_id' => $user->id]);

    //     $response = $this->actingAs($admin_user)
    //       ->delete("/articles/{$article->id}");

    //     $this->assertDatabaseMissing('articles', [
    //       'id' => $article->id,
    //       'title' => $article->title,
    //     ]);

    //     $response->assertRedirect();
    // }

    //user2の記事作成しuser1が削除
    public function test_failure_other_article_delete()
    {
      $user1 = factory(User::class)->create();
      $user2 = factory(User::class)->create();

      $article = factory(Article::class)->create(['user_id' => $user1->id]);

      $response = $this->actingAs($user2)
          ->delete("/articles/{$article->id}");

      $this->assertDatabaseHas('articles', [
        'id' => $article->id,
        'title' => $article->title,
      ]);

      //403コード:This action is unauthorized.
      $response->assertStatus(403);
    }
}