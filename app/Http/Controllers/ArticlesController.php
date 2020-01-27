<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Services\StoreArticle;
use App\Services\GetArticles;
use App\Services\GetTagList;
use App\Services\UpdateArticle;
use App\Services\DestroyArticle;
use App\Services\StoreImage;
use App\Services\GetArticlesByTag;

class ArticlesController extends Controller
{
  public function __construct() {
    $this->middleware('auth')->except(['index', 'show', 'domestic']); //ログインしなくてもみれる
  }

  public function index() {
    $get_articles = new GetArticles();
    $articles = $get_articles->get();

    return view('articles.index', compact('articles'));
  }

  public function show(Article $article) {
    return view('articles.show', compact('article'));
  }

  public function create() {
    $get_tag_list = new GetTagList();
    $tag_list = $get_tag_list->get_tag_list();

    return view('articles.create', compact('tag_list'));
  }

  public function store(ArticleRequest $request) {
    $service = new StoreArticle();
    $service->store($request->validated(), $request->input('tags'));

    return redirect()->route('articles.index')->with('message', '記事を追加しました。');
  }

  public function edit(Article $article) {
    $get_tag_list = new GetTagList();
    $tag_list = $get_tag_list->get_tag_list();

    return view('articles.edit', compact('article', 'tag_list'));
  }

  public function update(ArticleRequest $request, Article $article) {
    $update_article = new UpdateArticle();
    $update_article->update_article($request->validated(), $request->input('tags'),$article);

    return redirect()->route('articles.show', [$article->id])->with('message', '記事を更新しました。');
  }

  public function destroy(Article $article) {
    $destroy_article = new DestroyArticle();
    $destroy_article->destroy_article($article);

    return redirect()->route('articles.index')->with('message', '記事を削除しました。');
  }

  public function upload(Request $request, $article_id) {
    $store_image = new StoreImage();
    $successful_upload = $store_image->store_image($request, $article_id);

    if ($successful_upload === TRUE) {
      return redirect()->route('articles.show', [$article_id])->with('message', '記事を更新しました。');
    } else {
      return redirect()->back()->with('message', '画像の投稿に失敗しました。');
    }
  }

  public function domestic($tag_name) {
    $get_articles_by_tag = new GetArticlesByTag();
    $articles = $get_articles_by_tag->get_articles_by_tag();
 
    return view('articles.domestic', compact('articles','tag_name'));
  }

}
