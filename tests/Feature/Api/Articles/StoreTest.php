<?php

namespace Tests\Feature\Api\Articles;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Eloquent\User;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\ArticleImageRepositoryInterface;
use Illuminate\Http\UploadedFile;

class StoreTest extends TestCase
{
    //テスト終了後にデータベースを元に戻す
    use DatabaseTransactions;

    //成功

    //失敗
    //tag_idがない
    //imageがない
    //imageがjpeg,png形式じゃない
    //認証ずみのユーザでない

    private $user;
    private $file;

    protected function setUp(): void
    {
        parent::setUp();

        //認証用のユーザーを作成
        $this->user = factory(User::class)->create();
        $this->file = UploadedFile::fake()->create('file.png');
    }

    /**
     * タイトルが3文字
     */
    public function test_success_title_length_min()
    {
        //3文字のランダムの文字列
        $new_title = Str::random(3);

        $this->mock(ArticleImageRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('upload')->once();
        });

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            'aaaaa',
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseHas('articles', [
            'title' => $new_title,
            'body' => 'aaaaa',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Undocumented function
     *
     * @param int|null $user_id
     * @param string|null $title
     * @param string|null $body
     * @param string|null $published_at
     * @param int|null $tag_id
     * @param UploadedFile|null $file
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function postArticle(
        ?int $user_id,
        ?string $title,
        ?string $body,
        ?string $published_at,
        ?int $tag_id,
        ?UploadedFile $file
    )
    {
        return $this->actingAs($this->user)
            ->post("/api/articles", [
                'user_id' => $user_id,
                'title' => $title,
                'body' => $body,
                'published_at' => $published_at,
                'tag_id' => $tag_id,
                'image' => $file,
            ]);
    }

    //タイトルが50文字
    public function test_success_title_length_max()
    {
        $new_title = Str::random(50);

        $this->mock(ArticleImageRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('upload')->once();
        });

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            'aaaaa',
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseHas('articles', [
            'title' => $new_title,
            'body' => 'aaaaa',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    //内容(body)が100文字
    public function test_success_body_length_max()
    {
        $new_body = Str::random(100);

        $this->mock(ArticleImageRepositoryInterface::class, function ($mock) {
            $mock->shouldReceive('upload')->once();
        });

        $response = $this->postArticle(
            $this->user->id,
            'aaaaa',
            $new_body,
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseHas('articles', [
            'title' => 'aaaaa',
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    //タイトルがない
    public function test_failure_title_null()
    {
        $new_body = Str::random(10);

        $response = $this->postArticle(
            $this->user->id,
            '',
            $new_body,
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => '',
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //タイトルが3文字より少ない
    public function test_failure_title_length_min()
    {
        $new_body = Str::random(10);

        $file = UploadedFile::fake()->create('file.png');

        $response = $this->postArticle(
            $this->user->id,
            'aa',
            $new_body,
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => 'aa',
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //タイトルが50文字より多い
    public function test_failure_title_length_max()
    {
        $new_title = Str::random(51);
        $new_body = Str::random(10);

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            $new_body,
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title,
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //bodyがない
    public function test_failure_body_null()
    {
        $new_title = Str::random(5);

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            '',
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title,
            'body' => '',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //bodyが100文字より多い
    public function test_failure_body_length_max()
    {
        $new_title = Str::random(5);
        $new_body = Str::random(101);

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            $new_body,
            now()->format('Y-m-d'),
            1,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title,
            'body' => $new_body,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //published_atがない
    public function test_failure_published_at_null()
    {
        $new_title = Str::random(5);

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            'aaa',
            '',
            1,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title,
            'body' => 'aaa',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //published_atがdate型じゃない
    public function test_failure_published_at_date()
    {
        $new_title = Str::random(5);

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            'aaa',
            'aaaa-aa',
            1,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title,
            'published_at' => 'aaaa-aa',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * tag_idがない
     *
     * @return void
     */
    public function test_failure_tag_null()
    {
        $new_title = Str::random(5);

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            'aaaaaa',
            now()->format('Y-m-d'),
            null,
            $this->file
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * imageがない
     *
     * @return void
     */
    public function test_failure_image_null()
    {
        $new_title = Str::random(5);

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            'aaaaaa',
            now()->format('Y-m-d'),
            1,
            null
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * imageがjpeg,png形式じゃない
     *
     * @return void
     */
    public function test_failure_image_pdf()
    {
        $new_title = Str::random(5);

        $pdfFile = UploadedFile::fake()->create('file.pdf');

        $response = $this->postArticle(
            $this->user->id,
            $new_title,
            'aaaaaa',
            now()->format('Y-m-d'),
            1,
            $pdfFile
        );

        $this->assertDatabaseMissing('articles', [
            'title' => $new_title
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    //todo: 以下のテストは現在は302のリダイレクトが起こってしまいできない

    // /**
    //  * 認証済みのユーザでない
    //  *
    //  * @return void
    //  */
    // public function test_failure_not_auth()
    // {
    //   $new_title = Str::random(5);

    //   $response = $this->post("/api/articles", [
    //       'user_id' => 1,
    //       'title' => $new_title,
    //       'body' => 'aaaaaa',
    //       'published_at' => now()->format('Y-m-d'),
    //       'tag_id' => 1,
    //       'image' =>  $this->file
    //     ]);

    //   $this->assertDatabaseMissing('articles', [
    //     'title' => $new_title
    //   ]);

    //   $response->assertStatus(401);
    // }
}
