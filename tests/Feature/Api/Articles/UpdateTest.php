<?php

namespace Tests\Feature\Api\Articles;

use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Eloquent\User;
use App\Eloquent\Article;

class UpdateTest extends TestCase
{
    //テスト終了後にデータベースを元に戻す
    use DatabaseTransactions;

    private $user;
    private $file;

    protected function setUp(): void
    {
        parent::setUp();

        //認証用のユーザーを作成
        $this->user = factory(User::class)->create();
        $this->file = UploadedFile::fake()->create('file.png');
    }

    //タイトルが3文字
    public function test_success_title_length_min()
    {
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_title = Str::random(3);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => $new_title,
                'body' => 'aaaaa',
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => $new_title,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    //タイトルが50文字
    public function test_success_title_length_max()
    {
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_title = Str::random(50);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => $new_title,
                'body' => 'aaaaa',
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => $new_title,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    //内容(body)が100文字
    public function test_success_body_length_max()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_body = Str::random(100);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => 'aaaaa',
                'body' => $new_body,
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    //タイトルがない
    public function test_failure_title_null()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_body = Str::random(10);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => '',
                'body' => $new_body,
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //タイトルが3文字より少ない
    public function test_failure_title_length_min()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_body = Str::random(10);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => 'aa',
                'body' => $new_body,
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //タイトルが50文字より多い
    public function test_failure_title_length_max()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_title = Str::random(51);
        $new_body = Str::random(10);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => $new_title,
                'body' => $new_body,
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //bodyがない
    public function test_failure_body_null()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_title = Str::random(5);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => $new_title,
                'body' => '',
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'title' => $new_title,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //bodyが100文字より多い
    public function test_failure_body_length_max()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_title = Str::random(5);
        $new_body = Str::random(101);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => $new_title,
                'body' => $new_body,
                'published_at' => now(),
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'title' => $new_title,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //published_atがない
    public function test_failure_published_at_null()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_title = Str::random(5);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => $new_title,
                'body' => 'aaa',
                'published_at' => '',
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'title' => $new_title,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //published_atがdate型じゃない
    public function test_failure_published_at_date()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $new_title = Str::random(5);

        $response = $this->actingAs($this->user)
            ->put("/api/articles/{$article->id}", [
                'title' => $new_title,
                'body' => 'aaa',
                'published_at' => 'aaaa-aa',
                'tag_id' => 1,
                'image' => $this->file,
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
            'title' => $new_title,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
